					<!--begin::Footer-->
					<footer class="footer py-4 d-flex flex-lg-column" id="kt_footer">
						<!--begin::Container-->
						<div class="container-fluid d-flex justify-content-center">
							<!--begin::Copyright-->
							<div class="text-dark order-2 order-md-1">
								<span class="text-muted fw-bold me-1">{{ date('Y') }}©</span>
								<a href="https://keenthemes.com" target="_blank" class="text-gray-800 text-hover-primary">{{ setting('site_name') }}</a>
							</div>
							<!--end::Copyright-->
						</div>
						<!--end::Container-->
					</footer>
					<!--end::Footer-->

				</div>
				<!--end::Wrapper-->
			</div>
			<!--end::Page-->
		</div>
		<!--end::Root-->

		<!--start::Notifications-->
        @include('layouts.includes.backend.sections.notifications')
		<!--end::Notifications-->

        <audio id="play-audio" preload="auto"></audio>

		<!--begin::Javascript-->
        {{-- ************** START VENDOR JS ************** --}}
        {{-- To Forget Any Session --}}
        @php session()->forget(['success', 'failed', 'error', 'info', 'warning']); @endphp
        <script>
            var hostUrl = "{{ assetHelper('/') }}";
            const AUTH_ID = "{{ auth()->id() }}";
            const ENDPOINT = "{{ routeHelper('/') }}"; // Main project url
            const URL = "{{ url('/') }}"; // Main project url
            var successAudio = "{{ $successAudio }}"; // Success audio from setting or from defualt value
            var warrningAudio = "{{ $warrningAudio }}";  // Warring or error audio from setting or from defualt value
            var sound = false;
            var SWAL_TITLE = "@lang('title.are you sure')";
            var SWAL_MESSAGE = "@lang('title.you wont be able to revert this')";
            var SWAL_DELETE_BUTTON = "@lang('buttons.yes delete')";
            var SWAL_CANCEL_BUTTON = "@lang('buttons.cancel')";
            var SWAL_FAILED_TITLE = "@lang('title.please select some rows')";
        </script>

        <script type="text/javascript" src="/js/app.js"></script>
		<script src="{{ assetHelper('plugins/global/plugins.bundle.js') }}"></script>
		<script src="{{ assetHelper('js/scripts.bundle.js') }}"></script>
		<script src="{{ assetHelper('plugins/custom/datatables/datatables.bundle.js') }}"></script>


{{-- ************** START SWEETALERT JS ************** --}}
@include('sweetalert::alert')
{{-- ************** END SWEETALERT JS ************** --}}


{{-- ************** START CUSTOM JS ************** --}}
<script type="text/javascript" src="{{ assetHelper('customs/js/preview-file.js') }}"></script>
<script type="text/javascript" src="{{ assetHelper('customs/js/public-functions.js') }}"></script>

@if (setting('run_pusher', false))
    <script type="text/javascript" src="{{ assetHelper('customs/emails/js/pusher/email-notification.js') }}"></script>
@else
    <script type="text/javascript" src="{{ assetHelper('customs/emails/js/ajax/email-notification.js') }}"></script>
@endif

<script type="text/javascript" src="{{ assetHelper('customs/js/script.js') }}"></script>
<script type="text/javascript" src="{{ assetHelper('customs/js/check-offline.js') }}"></script>
{{-- ************** END CUSTOM JS ************** --}}

@yield('script')
@stack('script')
        {{-- Start :: To Make Menu Active --}}
        <script>
            $(function() {
                setInterval(function() { $('body').find('.remove-hidden-element').remove(); }, 1000);

                $(`div[data-route="{{ request()->route()->action['as'] }}"]`).each(function (index, ele) { activeMenu($(ele)); });

                function activeMenu(ele) {
                    ele.addClass('hover show');
                    $(`.menu-accordion[data-id="${ele.data('parent')}"]`).each(function (index, ele) {
                        activeMenu($(ele));
                    });
                }

                // Remove Any Menu Not Have Sub
                $('.menu-item.menu-accordion').filter(function(){
                    if ($(this).find('.menu-sub-accordion').length > 0 && $.trim($(this).find('.menu-sub-accordion').text()).length == 0)
                        $(this).remove();
                });

                $('.menu-item.menu-accordion').filter(function(){
                    if ($(this).find('.menu-sub-accordion').length > 0 && $.trim($(this).find('.menu-sub-accordion').text()).length == 0)
                        $(this).remove();
                });
            });
        </script>
        {{-- End :: To Make Menu Active --}}

        {{-- Start :: To Remove Loading Page && Run Audio --}}
        <script type="text/javascript">
            $(function() {
                if ($('.swal2-icon-success').length || "{{ session()->has('success') }}") playAudio('success');
                if ($('.swal2-icon-error').length || "{{ session()->has('failed') }}" || "{{ session()->has('warning') }}" || "{{ session()->has('error') }}") playAudio('warning');
                // To Remove Loading Page
                $('.blockui-message').fadeOut(50, function() { $(this).remove(); });
            });
        </script>
        {{-- End :: To Remove Loading Page && Run Audio --}}

        <script>
            $(function() {
                let audio = $('#play-audio');
                $('body').on('click', '[data-play-audio]', function(e) {
                    e.preventDefault();
                    let playStatus = $(this).find('i').data('audio-status');

                    $('body').find('[data-play-audio]').not($(this)).each(function() {
                        $(this).find('i').addClass('fa-volume-mute').removeClass('fa-volume-up').data('audio-status', false);
                    });

                    $(this).find('i').toggleClass('fa-volume-mute').toggleClass('fa-volume-up').data('audio-status', ! playStatus);

                    if (playStatus) {
                        audio[0].pause();
                    } else {
                        audio.attr('src', $(this).data('audio-path'));
                        audio[0].play();
                    }
                });
            });
        </script>

        <script>
            $(function() {
                let new_message_remove_time = null;
                window.Echo.private(`new-message.{{ auth()->id() }}`)
                    .listen('\\App\\Events\\Messenger\\MessageCreated', (data) => {
                        let counter = Number.parseInt($('#all-unread-messages').text());
                        $('#all-unread-messages').text(counter+1);
                        $('#new-message').empty().removeClass('d-none').fadeIn(500, function() { $(this).append(`<b>${data.message.user.name}:</b> ${data.message.message}`); });
                        if (new_message_remove_time) clearTimeout(new_message_remove_time);
                        new_message_remove_time = setTimeout(() => {
                            $('#new-message').fadeOut(500, function() { $(this).removeClass('d-none'); });
                        }, 3000);
                        sound = true;
                        playAudio();
                    });


                window.Echo.join(`chat`).listenForWhisper('unread-count', (e) => {
                        if ({{ auth()->id() }} != e.auth_id) return;
                            $('#all-unread-messages').text(e.count)
                    });

            });
        </script>

	</body>
	<!--end::Body-->
</html>
