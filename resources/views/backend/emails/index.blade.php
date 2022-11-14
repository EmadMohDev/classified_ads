@extends('layouts.backend')

@section('content')
    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <!--begin::Inbox App - Messages -->
            <div class="d-flex flex-column flex-lg-row">

                <!--begin::Sidebar-->
                @include('backend.emails.includes.sidebar')
                <!--end::Sidebar-->

                <!--begin::Content-->
                @include('backend.emails.includes.content')
                <!--end::Content-->
            </div>
            <!--end::Inbox App - Messages -->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
@endsection

@section('script')
    <script type="text/javascript" src="{{ assetHelper('customs/emails/js/email-app.js') }}"></script>
@endsection
