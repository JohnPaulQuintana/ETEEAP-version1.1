<x-app-layout>
    @section('links')
        <style>
            /* #history-card li div h3 span.noti:not(:first-child):not(:first-of-type) {
                    display: none;
                } */
        </style>
    @endsection
    <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-5">

        <div class="mt-10">
            <div class="flex justify-between">
                <div class="flex">
                    <a href="{{ route('user-dashboard') }}" class="text-red-500 mx-2 font-bold pl-2 dark:text-white"><i
                            class="fa-regular fa-arrow-left"></i> Back</a>
                    <h1 class="text-blue-900 mx-2 font-bold border-l-4 pl-2 dark:text-white">Application Status </h1>

                </div>
                @include('partials.breadcrumb')
            </div>

            <div class="shadow-xl rounded-md mt-4 relative z-0">

                <!--content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">

                    <!--body -->
                    <div class="p-4 md:p-5">
                        <ol id="history-card"
                            class="relative border-s border-gray-200 dark:border-gray-600 ms-3.5 mb-4 md:mb-5">

                            @foreach ($histories as $history)
                                @php
                                    $classNameBg = '';
                                @endphp
                                @switch($history->status)
                                    @case('rejected')
                                        @php
                                            $classNameBg = 'text-red-500';
                                        @endphp
                                    @break

                                    @case('in-review')
                                        @php
                                            $classNameBg = 'text-orange-400';
                                        @endphp
                                    @break

                                    @case('accepted')
                                        @php
                                            $classNameBg = 'text-green-400';
                                        @endphp
                                    @break

                                    @default
                                        @php
                                            $classNameBg = 'text-yellow-400';
                                        @endphp
                                    @break
                                @endswitch
                                <li class="shadow-md p-2 mb-10 ms-8 grid grid-cols-1 lg:grid-cols-2 gap-2">
                                    <div>
                                        <span
                                            class="absolute flex items-center justify-center w-6 h-6 bg-gray-100 rounded-full -start-3.5 ring-8 ring-white dark:ring-gray-700 dark:bg-gray-600">
                                            <i class="fa-sharp fa-solid fa-circle w-2.5 h-2.5 text-red-500"></i>
                                        </span>
                                        <h3
                                            class="flex items-start mb-1 text-lg font-semibold text-blue-900 dark:text-white">
                                            ETEEAP APPLICATION
                                            @php
                                                $statusText = '';

                                                switch ($history->status) {
                                                    case 'accepted':
                                                        $statusText = 'Approved';
                                                        break;
                                                    case 'rejected':
                                                        $statusText = 'Rejected';
                                                        break;
                                                    case 'pending':
                                                        $statusText = 'Pending';
                                                        break;
                                                    case 'in-review':
                                                        $statusText = 'Under Review';
                                                        break;
                                                    default:
                                                        $statusText = 'On-Hold';
                                                }
                                            @endphp
                                            <span
                                                class="bg-gray {{ $classNameBg }} text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300 ms-3">
                                                {{ $statusText }}
                                            </span>
                                            {{-- @if ($history->status !== 'accepted') --}}
                                            <span
                                                class="noti bg-red-500 hover:bg-red-700 hover:cursor-pointer text-white text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300 ms-3">
                                                Notify
                                            </span>
                                            {{-- @endif --}}
                                        </h3>
                                        <time
                                            class="block mb-3 text-sm font-normal leading-none text-blue-900 dark:text-gray-400"><span
                                                class="font-bold">Date :</span>
                                            {{ \Carbon\Carbon::parse($history->created_at)->format('Y-m-d') }}</time>
                                        <time
                                            class="block mb-3 text-sm font-normal leading-none text-blue-900 dark:text-gray-400"><span
                                                class="font-bold">Time :</span>
                                            {{ \Carbon\Carbon::parse($history->created_at)->format('h:i A') }}</time>
                                        <span
                                            class="block rounded-md p-2 mb-3 text-blue-900 text-md font-normal leading-none bg-gray-2 dark:text-gray-400">{{ $history->notes }}</span>

                                        @if ($history->status === 'accepted')
                                            <div
                                                class="rounded-md p-2 mb-3 text-blue-900 text-md font-normal text-center leading-none bg-gray-2 dark:text-gray-400">
                                                <i class="fa-solid fa-envelope-circle-check text-4xl"></i>
                                                <p class="mb-5 text-green-500 text-2xl">Application Approved</p>
                                                <p>Thank you for your patience. Kindly follow the instructions listed
                                                on the program details provided on the main page.</p>

                                            </div>
                                        @endif

                                        @if ($history->status === 'rejected')
                                            <div
                                                class="rounded-md p-2 mb-3 text-blue-900 text-md font-normal text-center leading-none bg-gray-2 dark:text-gray-400">
                                                <i class="fa-solid fa-file-circle-xmark text-4xl"></i>
                                                <p class="mb-5 text-red-500 text-2xl">Application Rejected</p>
                                                <p>We regret to inform you that your application has been rejected. We
                                                    appreciate the time and effort you put into the application process.
                                                </p>

                                            </div>
                                        @endif

                                    </div>

                                    {{--  comments --}}
                                    <div class="border border-gray-2 rounded-md bg-gray-2 p-2 text-blue-900 w-full c-con">
                                        <span class="font-bold">Comments</span>
                                        <div class="">
                                            {{-- list of resubmit docs --}}
                                            {{-- {{ $internalMessages }} --}}
                                            @if (isset($internalMessages) && count($internalMessages) > 0)
                                                @foreach ($internalMessages as $im)
                                                {{-- {{ $im }} --}}
                                                    <div class="text-wrap w-full mt-3">
                                                        <div class="break-words">

                                                            <span
                                                                class="block text-left rounded-md bg-white mb-1">

                                                                <div class="flex items-start gap-1.5 content">
                                                                    <div class="flex flex-col w-full">
                                                                        <div
                                                                            class="flex flex-col w-full leading-1.5 p-4 border-gray-200 bg-gray-100 rounded-e-xl rounded-es-xl dark:bg-gray-700">
                                                                            <div
                                                                                class="flex items-center space-x-2 rtl:space-x-reverse">
                                                                                {{-- <span
                                                                                    class="text-sm font-semibold text-gray-900 p-1 dark:text-white">
                                                                                    {{ __('ETEEAP Department') }}
                                                                                </span> --}}
                                                                                @if (Auth::user()->id === $im->sender_id)
                                                                                    <span
                                                                                        class="text-sm font-semibold text-gray-900 p-1 dark:text-white">
                                                                                        {{ Auth::user()->name }}
                                                                                    </span>
                                                                                @else
                                                                                    <span
                                                                                            class="text-sm font-semibold text-gray-900 p-1 dark:text-white">
                                                                                            {{ __('ETEEAP Department') }}
                                                                                    </span>
                                                                                @endif
                                                                                <span
                                                                                    class="text-sm font-normal bg-gray p-[2px] rounded-sm dark:text-gray-400">
                                                                                    {{ \Carbon\Carbon::parse($im->created_at)->format('h:i A') }}
                                                                                </span>
                                                                                <span
                                                                                    class="text-sm font-normal bg-gray p-[2px] rounded-sm text-red-500 dark:text-gray-400">{{ $im->action_required }}</span>
                                                                            </div>
                                                                            <div
                                                                                class="flex justify-between w-full items-start bg-gray-50 dark:bg-gray-600 rounded-xl p-2">
                                                                                <div class="me-2">

                                                                                    
                                                                                    <span
                                                                                        class="mt-2 text-slate-900">
                                                                                        <i class="fa-solid fa-chevrons-right"></i>
                                                                                        {{ $im->message }}
                                                                                    </span>
                                                                                </div>
                                                                                <div
                                                                                    class="inline-flex self-center items-center">
                                                                                    @if ($im->action_required === 'Additional Documents Required')
                                                                                        <button
                                                                                            data-document_id="{{ $im->document->id }}"
                                                                                            data-sender_id="{{ $im->sender_id }}"
                                                                                            {{-- data-id="{{ $dec->id }}"
                                                                                            data-document_id="{{ $dec->document_id }}"
                                                                                            data-subname="{{ $dec->sub_name }}"
                                                                                            data-document_name="{{ $dec->requirements }}" --}}
                                                                                            class="reupload inline-flex bg-blue-900 self-center items-center p-2 text-sm font-medium text-center text-white bg-gray-50 rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none dark:text-white focus:ring-gray-50 dark:bg-gray-600 dark:hover:bg-gray-500 dark:focus:ring-gray-600"
                                                                                            type="button">
                                                                                            <i
                                                                                                class="fa-solid fa-envelope-open-text text-md"></i>
                                                                                        </button>
                                                                                    @endif

                                                                                    @if ($im->action_required === 'Applicant Response Needed')
                                                                                        <button
                                                                                            data-document_id="{{ $im->document->id }}"
                                                                                            data-sender_id="{{ $im->sender_id }}"
                                                                                            
                                                                                            class="remessage inline-flex bg-blue-900 self-center items-center p-2 text-sm font-medium text-center text-white bg-gray-50 rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none dark:text-white focus:ring-gray-50 dark:bg-gray-600 dark:hover:bg-gray-500 dark:focus:ring-gray-600"
                                                                                            type="button">
                                                                                            <i class="fa-sharp fa-solid fa-paper-plane-top text-md"></i>
                                                                                        </button>
                                                                                    @endif

                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                    </div>

                                                                </div>



                                                            </span>

                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                                
                                            @endif
                                           



                                        </div>
                                    </div>

                                </li>
                            @endforeach



                        </ol>
                       


                    </div>
                </div>


            </div>

        </div>

    </div>
    @include('popup.comments')
    @include('popup.user-response')
    @section('scripts')
        <script>
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            $(document).ready(function() {
                // hide all the passed history
                $('#history-card li div h3 span.noti').not(':first').hide();
                $('.c-con > content').not(':first').hide();
                $('.c-con').not(':first').html(`<div class="text-slate-400 flex flex-col justify-center items-center p-5"><h1>No comments available.</h1></div>`)

                const $comments = document.getElementById('comments-modal');
                const $message = document.getElementById('message-modal');

                // options with default values
                const optionComments = {
                    placement: 'bottom-right',
                    backdrop: 'static',
                    backdropClasses: 'bg-blue-900/50 dark:bg-blue-900/80 fixed inset-0 z-40',
                    closable: true,
                    onHide: () => {
                        console.log('modal is hidden');
                        $('#reuploadDocs').val('')
                        $('#reuploadComment').val('')

                    },
                    onShow: () => {
                        console.log('modal is shown');
                    },
                    onToggle: () => {
                        console.log('modal has been toggled');
                    },
                };
                const instanceOptionsC = {
                    id: 'comments-modal',
                    override: true
                };

                // options with default values
                const optionMessage = {
                    placement: 'bottom-right',
                    backdrop: 'static',
                    backdropClasses: 'bg-blue-900/50 dark:bg-blue-900/80 fixed inset-0 z-40',
                    closable: true,
                    onHide: () => {
                        console.log('modal is hidden');
                        $('#sendMessage').val('')

                    },
                    onShow: () => {
                        console.log('modal is shown');
                    },
                    onToggle: () => {
                        console.log('modal has been toggled');
                    },
                };
                const instanceOptionsM = {
                    id: 'message-modal',
                    override: true
                };

                const cm = new Modal($comments, optionComments, instanceOptionsC);
                const m = new Modal($message, optionMessage, instanceOptionsM);

                $(document).on('click', '.reupload', function() {
                    let checkedId = $(this).data('id')
                    let documentId = $(this).data('document_id')
                    let checkedName = $(this).data('document_name')
                    let checkedSubName = $(this).data('subname')
                    let senderId = $(this).data('sender_id')
                    // $('#reuploadLable').text('1. ' + checkedName)
                    $('#checkedId').val(parseInt(checkedId))
                    $('#documentId').val(parseInt(documentId))
                    $('#senderId').val(parseInt(senderId))
                    $('#checkedName').val(checkedName)
                    $('#checkedSubName').val(checkedSubName)
                    cm.show()
                })

                $(document).on('click', '.remessage', function(){
                    // let checkedId = $(this).data('id')
                    let documentId = $(this).data('document_id')
                    // let checkedName = $(this).data('document_name')
                    // let checkedSubName = $(this).data('subname')
                    let senderId = $(this).data('sender_id')

                    // $('#checkedId').val(parseInt(checkedId))
                    $('#m_documentId').val(parseInt(documentId))
                    $('#m_senderId').val(parseInt(senderId))
                    // $('#checkedName').val(checkedName)
                    // $('#checkedSubName').val(checkedSubName)
                    m.show()
                })

                $(document).on('click', '.c-close', function() {
                    $('#reuploadLable').text('')
                    $('#reuploadDocs').text('')
                    $('#checkedId').val('')
                    $('#documentId').val('')
                    $('#checkedName').val('')
                    $('#checkedSubName').val('')
                    cm.hide()
                })
                $(document).on('click', '.m-close', function() {
                   
                    
                   
                    $('#m_documentId').val('')
                    $('#m_senderId').val('')
                    $('#sendMessage').val('')

                    m.hide()
                })

                $(document).on('click', '.noti', function() {
                    setNotify()
                })


                function setNotify() {
                    Swal.fire({
                        title: "Notify the Department",
                        html: `<div class="rounded-md p-3">
                              
                                <div class="mb-2">
                                    
                                    <textarea id="notify-message" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write a message here..."></textarea>
                                </div>
                               
                            </div>`,
                        inputAttributes: {
                            autocapitalize: "off"
                        },
                        showCancelButton: true,
                        confirmButtonText: "Notify Department",
                        showLoaderOnConfirm: true,
                        allowOutsideClick: false,
                        preConfirm: async () => {

                            var message = $('#notify-message').val()
                            // console.log(interviewer, date, time, address, details, user_id)
                            if (message == '') {
                                return Swal.showValidationMessage(`Notify message is required to submit`)
                            }

                            try {
                                // let data = {'user_id': user_id, 'interviewer': interviewer, 'date':date, 'time':time, 'address':address, 'message':message}
                                const response = await fetch(`{{ route('notify') }}`, {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': csrfToken
                                    },
                                    body: JSON.stringify({
                                        'message': message
                                    }),
                                });

                                if (!response.ok) {
                                    return Swal.showValidationMessage(`
                                    ${JSON.stringify(await response.json())}
                                    `);
                                }
                                return response.json();

                            } catch (error) {
                                Swal.showValidationMessage(`
                                    Request failed: ${error}
                                `);
                            }
                        },
                        // allowOutsideClick: () => !Swal.isLoading()
                    }).then((result) => {
                        if (result.isConfirmed) {
                            console.log(result)
                            Swal.fire({
                                title: "Notified successfully!",
                                text: `${result.value.message}`,
                                icon: "success"
                            });

                            setTimeout(() => {
                                // if(result.value.refresh){
                                window.location.reload()
                                // }
                            }, 3000);
                        }
                    });
                }
            })
        </script>
    @endsection
</x-app-layout>
