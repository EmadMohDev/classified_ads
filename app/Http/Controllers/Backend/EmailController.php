<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmailRequest;
use App\Mail\SendEmail;
use App\Models\Email;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function count() // get count of emails not seen for authentcation user
    {
        return Email::onTo()->onCC()->seen(EMAIL_UNSEEN)->count();
    }

    public function list($view = 'backend.emails.includes.single-email', $limit = 8) // list emails in notification icon
    {
        $emails = Email::filter()->with('notifier')->paginate($limit);
        $next_page = $emails->currentPage() < $emails->lastPage()
                        ? "{$emails->path()}?page=".($emails->currentPage() + 1)
                        : null;

        return response()->json([
            'emails' => view($view, compact('emails'))->render(),
            'next_page' => $next_page
        ]);
    }

    public function new($limit = 1) // Get the latest new emails
    {
        $emails = Email::onTo()->onCC()->seen(EMAIL_UNSEEN)->with('notifier')->limit($limit)->get();
        return response()->json([
            'emails' => view('backend.emails.includes.single-email', compact('emails'))->render(),
        ]);
    }

    public function index() // list Email page without emails
    {
        if (request()->ajax()) { // Show email Content by id
            return self::list('backend.emails.includes.list-rows', 10);
        }
        return view('backend.emails.index');
    }

    public function create()
    {
        return view('backend.includes.pages.form-page', ['use_form_ajax' => true, 'users' => User::pluck('email')->toArray(), 'title' => "Compose Message"]);
    }

    public function store(EmailRequest $request)
    {
        Mail::send(new SendEmail( createEmail($request->validated()) ));
        toast(trans('flash.row created', ['model' => trans('menu.email')]), 'success');
        return response()->json([
            'redirect' => routeHelper("emails.index"),
        ]);
    }

    public function show($id)
    {
        $email = Email::current()->where('id', $id)->first();
        if (!$email) {
            toast(trans('flash.something is wrong'), 'error');
            return redirect()->back();
        }

        $email->updateSeen();

        $view = null;
        if($email->view && $email->model) {
            $model = app($email->model);
            $models = app($email->model)::relations()->whereIn('id', explode(',', $email->ids))->get();
            foreach ($models as $model) {
                $view .= view($email->view, ['row' => $model])->render();
            }
        }

        return view('backend.emails.show', compact('email', 'view'));
    }

    public function destroy($id)
    {
        try {
            Email::find($id)->delete();
            return response()->json(['message' => trans('flash.row deleted', ['model' => trans('menu.email')])]);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    public function readAll()
    {
        foreach (Email::onTo()->onCC()->seen(EMAIL_UNSEEN)->get() as $email) {
            DB::beginTransaction();
                $email->updateSeen();
            DB::commit();
        }

        return redirect()->back();
    }

    public function multidelete(Request $request)
    {
        try {
            $ids = (array) $request['id'];
            Email::whereIn('id', $ids)->delete();
            return response()->json(['message' => trans('flash.rows deleted', ['count' => count($ids), 'model' => trans('menu.email')]), 'icon' => 'success']);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }
}
