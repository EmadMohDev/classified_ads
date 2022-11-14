<?php

namespace App\Http\Services;

use Exception;
use App\Models\Rbt;

class RbtService {

    public function handle($request, $id = null)
    {
        try {
            if (isset($request['rbts']) && count($request['rbts']) > 0) {
                foreach($request['rbts'] as $rbt)
                    $row = Rbt::create($rbt + ['content_id' => $request['content_id']]);
            } else {
                $row = Rbt::updateOrCreate(['id' => $id], $request);
            }
            return $row;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
