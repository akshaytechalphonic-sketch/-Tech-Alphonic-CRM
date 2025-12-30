@extends('office.partical.main')
@push('title')
    <title>Dashboard | Admin</title>
@endpush

@push('custom-css')
@endpush

@section('content')
<!--work on other object-->
<script src="https://cdn.socket.io/4.0.1/socket.io.min.js"></script>
    @php
        $route = \Request::route()->getName();
    @endphp
    <style>
        .employeeList:hover{
            background-color: #f7f7f7;
        }
        #remarks::-webkit-scrollbar-track, .listEmp::-webkit-scrollbar-track
        {
        	    background-color: rgba(var(--bs-light-rgb), var(--bs-bg-opacity)) !important;
        }
        
        #remarks::-webkit-scrollbar,.listEmp::-webkit-scrollbar
        {
        	width: 6px;
        	    background-color: rgba(var(--bs-light-rgb), var(--bs-bg-opacity)) !important;
        }
        
        #remarks::-webkit-scrollbar-thumb, .listEmp::-webkit-scrollbar-thumb
        {
        	background-color: #c0c0c0;
        }
        #selectedFile{
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
        }
        .appendedMessage .file{
            width: 100%;
            max-width:50%;font-size:13px;;
            height: 150px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        .customProgress{
            width: 250px;
            height: 5px;
            background: #ffffff;
        }
        .innerCustomProgress{
            width: 20%;
            height: 100%;
            background: #000000;
        }
        .customProgress.rounded-pill.overflow-hidden:before {
            content: attr(data-percentage);
            position: absolute;
            top: 4px;
            font-size: 12px;
            font-weight: 600;
        }
        .addNewChat {
            display:flex;
            justify-content:center;
            align-items:center;
            width:45px;
            height:45px;
            border-radius:1000px;
            background-color: var(--bs-dark-bg-subtle) !important;
            cursor:pointer;
            position:absolute;
            bottom:5%;
            right:5%
        }
        .messageTime{
            font-size: 10px;
        }
    </style>
    <div class="main-content">
        <!-- write-body-content here start -->
        <div class="pages-content">
             <div class="row m-0">
                    <div class="col-4 mb-0">
                        <div class="bg-white rounded p-3 pb-0 position-relative listEmp" id="chattedEMpList"  style="height: 100vh; max-height: calc(97vh - 100px); overflow: hidden scroll;">
                            <div class="step-title">
    <div class="d-flex align-items-center mb-2">
        <input id="empSearchInput" class="form-control me-2 shadow-none border" type="search" placeholder="Search name..." />
        <a class="btn rounded-pill fs-5 p-2 py-1 border" href="{{url()->current()}}">
            <i class="fa-solid fa-rotate"></i>
        </a>
    </div>

    <script>
    // Put this script AFTER the list
    document.getElementById("empSearchInput").addEventListener("keyup", function() {
        const searchText = this.value.toLowerCase();
        
        // Get ALL items with employeeList class
        const allEmployees = document.querySelectorAll('.employeeList');
        
        allEmployees.forEach(employee => {
            // Get name text
            const nameElement = employee.querySelector('span');
            const name = nameElement ? nameElement.textContent.toLowerCase() : '';
            
            // Get message text
            const msgElement = employee.querySelector('small');
            const message = msgElement ? msgElement.textContent.toLowerCase() : '';
            
            // Show or hide based on search
            if (name.includes(searchText) || message.includes(searchText)) {
                employee.style.display = 'flex'; // Show
            } else {
                employee.style.display = 'none'; // Hide
            }
        });
    });
    </script>

    <ul id="employeeList" class="list-group list-group-flush">
        @if(isset($chat_with) && !str_contains(json_encode($chattedEMp, true),'"user_id":'.$chat_with->id))
        <li data-id="{{$chat_with->id}}" 
            class="list-group-item align-items-center employeeList {{$chat_with->id == $chat_with->id ? 'bg-light' : ''}}" 
            style="cursor:pointer;display:flex;" 
            onclick="window.location.href='{{route('office_employee.chats.singleChat',['emp_base64'=> base64_encode(json_encode(['id'=>$chat_with->id,'name'=>$chat_with->id]))])}}'">
            <div class="profileImage overflow-hidden rounded-pill me-3 h-100" style="width: 45px;height: 45px;">
                <img style="aspect-ratio: 1;object-fit: cover;" src="https://media.istockphoto.com/id/1682296067/photo/happy-studio-portrait-or-professional-man-real-estate-agent-or-asian-businessman-smile-for.jpg?s=612x612&w=0&k=20&c=9zbG2-9fl741fbTWw5fNgcEEe4ll-JegrGlQQ6m54rg=" />
            </div>
            <div class="profileContent w-75">
                <span>{{$chat_with->name}}</span><br>
                <small class="text-truncate d-block w-100"></small>
            </div>
        </li>
        @endif
        
        @foreach($chattedEMp as $item)
        <li data-id="{{$item->user_id}}" 
            class="list-group-item align-items-center employeeList {{isset($chat_with->id) && $chat_with->id == $item->user_id ? 'bg-light' : ''}}" 
            style="cursor:pointer; display:flex;" 
            onclick="window.location.href='{{route('office_employee.chats.singleChat',['emp_base64'=> base64_encode(json_encode(['id'=>$item->user_id,'name'=>$item->name]))])}}'">
            <div class="profileImage overflow-hidden rounded-pill me-3 h-100" style="width: 45px;height: 45px;">
                <img style="aspect-ratio: 1;object-fit: cover;" src="https://media.istockphoto.com/id/1682296067/photo/happy-studio-portrait-or-professional-man-real-estate-agent-or-asian-businessman-smile-for.jpg?s=612x612&w=0&k=20&c=9zbG2-9fl741fbTWw5fNgcEEe4ll-JegrGlQQ6m54rg=" />
            </div>
            <div class="profileContent w-75">
                <span>{{$item->name}}</span><br>
                <small class="text-truncate d-block w-100">{{$item->message}}</small>
            </div>
        </li>
        @endforeach
    </ul>
</div>
                            <div class="addNewChat shadow" data-bs-toggle="modal" data-bs-target="#addNewChat"><i class="fa-solid fa-plus"></i></div>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="bg-white rounded p-3 h-100">
                            @if(isset($chat_with))
                            <div class="step-title ">
                                <h6 class="d-flex align-items-center"> 
                                <div class="profileImage overflow-hidden rounded-pill me-3 h-100" style="width: 45px;height: 45px;">
                                    <img style="aspect-ratio: 1;object-fit: cover;" src="https://media.istockphoto.com/id/1682296067/photo/happy-studio-portrait-or-professional-man-real-estate-agent-or-asian-businessman-smile-for.jpg?s=612x612&w=0&k=20&c=9zbG2-9fl741fbTWw5fNgcEEe4ll-JegrGlQQ6m54rg=" />
                                </div>
                                <div class="profileContent w-75">
                                    <span>{{$chat_with->name}}</span><br>
                                    <small class="fw-light">{{$chat_with->designation->designation_name}}</small>
                                </div>
                                <a href="tel:{{str_contains($chat_with->mobile_no, "91") ? '' : '91'.$chat_with->mobile_no}}" class="me-4"><i class="fa-solid fa-phone"></i></a>
                                <a href="mailto:{{$chat_with->email}}"><i class="fa-solid fa-envelope"></i></a>
                                </h6>
                            </div>
                            <div class="position-relative">
                                
                                <div id="remarks" data-id="{{$chat_with->id}}" class="bg-light mb-3 rounded p-3 d-flex flex-column-reverse overflow-y-scroll" style="scroll-behavior: smooth;height: calc(77vh - 100px);">
                                    @foreach($messages as $mess)
                                        @php
                                        $file = json_decode($mess->file, true);
                                        @endphp
                                        @if($mess->sender_id == $chat_with->id)
                                        <div class="w-100 d-flex {{$mess->file != null ? 'flex-column' : ''}} justify-content-start mb-2 appendedMessage">
                                                @if($mess->file != null)
                                            <div class="file bg-dark-subtle text-dark rounded-3 rounded-bottom-0 position-relative">
                                                <i class="fa-solid fa-file display-6 mb-3"></i>
                                                <span class="fs-6 fw-light mb-2 px-3 text-center">{{$file['name']}}</span>
                                                <div class="actions position-relative">
                                                    <a href="{{url('public/'.$file['path'])}}" target="_blank" class="me-2"><i class="fa-solid fa-eye"></i></a><a href="{{'public/'.$file['path']}}" download="{{$file['name']}}"><i class="fa-solid fa-circle-down"></i></a>
                                                </div>
                                            </div>
                                            @endif
                                            <div class="overflow-hidden mb-0 text-dark rounded-3 {{$mess->file != null ? 'rounded-top-0 border-top' : ''}}  text-wrap p-2 py-1 m-0 shadow-sm d-inline-block bg-dark-subtle" style="max-width:50%;font-size:13px;word-break: break-all;">
                                                {!! !filter_var($mess->message, FILTER_VALIDATE_URL) ? $mess->message : "<a class='link-primary' target='_blank' href='{$mess->message}'>{$mess->message}</a>"!!}<br>
                                                <small class="messageTime">{{date('h:i A',strtotime($mess->created_at))}}</small>
                                            </div>
                                        </div>
                                        @else
                                        <div class="w-100 d-flex {{$mess->file != null ? 'flex-column align-items-end' : 'justify-content-end'}} mb-2 appendedMessage">
                                            @if($mess->file != null)
                                            <div class="file bg-dark text-white rounded-3 rounded-bottom-0 position-relative">
                                                <i class="fa-solid fa-file display-6 mb-3"></i>
                                                <span class="fs-6 fw-light mb-2 px-3 text-center">{{$file['name']}}</span>
                                                <div class="actions position-relative">
                                                    <a href="{{url('public/'.$file['path'])}}" target="_blank" class="me-2"><i class="fa-solid fa-eye"></i></a><a href="{{'public/'.$file['path']}}" download="{{$file['name']}}"><i class="fa-solid fa-circle-down"></i></a>
                                                </div>
                                            </div>
                                            @endif
                                            <div class="overflow-hidden mb-0 text-white rounded-3 {{$mess->file != null ? 'rounded-top-0 w-100 border-top' : ''}} text-wrap p-2 py-1 m-0 shadow-sm d-inline-block bg-dark" style="max-width:50%;font-size:13px;word-break: break-all;">
                                                {!! !filter_var($mess->message, FILTER_VALIDATE_URL) ? $mess->message : "<a class='link-primary' target='_blank' href='{$mess->message}'>{$mess->message}</a>" !!}<br>
                                                <small class="float-end messageTime">{{date('h:i A',strtotime($mess->created_at))}}</small>
                                            </div>
                                        </div>
                                        @endif
                                    @endforeach
                                </div>
                                <div id="selectedFile" class="d-flex justify-content-center align-items-center flex-column z-3 text-white d-none" style="backdrop-filter: brightness(0.2);">
                                </div>
                            </div>
                            <form class="row m-0" id="sendMessage" enctype="multipart/form-data">
                                @csrf
                                <div class="col-12 customEditor" contenteditable="true">
                                        
                                </div>
                                
                                <div class="col-12 pe-0 d-flex p-0">
                                    <label type="button" for="selectFile" class="btn me-2 rounded-pill fs-5 p-0 btn btn-outline-light text-dark shadow-sm px-3 d-flex justify-content-center align-items-center"><i class="fa-solid fa-file"></i></label>
                                    
                                    <input name="message" id="messageInput" class="form-control w-100 rounded-5 shadow-sm" placeholder="Write Message" rows="1" autocomplete="off" required>
                                    <input type="hidden" value="{{$login_employee->id}}" name="sender_id">
                                    <input type="hidden" value="{{$chat_with->id}}" name="receiver_id">
                                    <input name="file" type="file"id="selectFile" class="d-none">
                                    <!--</textarea>-->
                                    <button type="submit" class="btn btn-primary ms-2 rounded-pill"><i class="fa-solid fa-paper-plane"></i></button>
                                </div>
                            </form>
                            @else
                            <div class="w-100 h-100 text-muted d-flex justify-content-center align-items-center flex-column">
                                <i class="display-2 fa-regular fa-message mb-3"></i>
                                <h4>Select your friend...</h4>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
        </div>
        <!-- write-body-content here end -->
    </div>

    </div>
    </section>
</div>
<!--data-bs-toggle="modal" data-bs-target="#addNewChat"-->

<!-- Modal -->
<div class="modal fade" id="addNewChat" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addNewChatLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header border-none">
        <h1 class="modal-title fs-5" id="addNewChatLabel">Add New Chat</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-header">
        <input id="modalSearchInput" class="form-control rounded-0 border shadow-none" type="search" placeholder="Search name..." />
      </div>
      <div class="modal-body listEmp">
        <ul id="modalEmployeeList" class="list-group list-group-flush">
            @foreach($employee as $item)
            <li data-id="{{$item->user_id}}" class="list-group-item align-items-center employeeList" style="cursor:pointer;display:flex;" onclick="return window.location.href='{{route('office_employee.chats.singleChat',['emp_base64'=> base64_encode(json_encode(['id'=>$item->id,'name'=>$item->name]))])}}'">
                <div class="profileImage overflow-hidden rounded-pill me-3 h-100" style="width: 45px;height: 45px;">
                    <img style="aspect-ratio: 1;object-fit: cover;" src="https://media.istockphoto.com/id/1682296067/photo/happy-studio-portrait-or-professional-man-real-estate-agent-or-asian-businessman-smile-for.jpg?s=612x612&w=0&k=20&c=9zbG2-9fl741fbTWw5fNgcEEe4ll-JegrGlQQ6m54rg=" />
                </div>
                <div class="profileContent w-75">
                    <span>{{$item->name}}</span><br>
                    <small class="text-truncate d-block w-100">{{$item->message}}</small>
                </div>
            </li>
            @endforeach
        </ul>
      </div>
    </div>
  </div>
</div>

<script>
// Search functionality for modal
document.addEventListener('DOMContentLoaded', function() {
    const modalSearchInput = document.getElementById('modalSearchInput');
    
    if (modalSearchInput) {
        modalSearchInput.addEventListener('keyup', function() {
            const searchText = this.value.toLowerCase();
            const employeeItems = document.querySelectorAll('#modalEmployeeList .employeeList');
            
            employeeItems.forEach(item => {
                const nameElement = item.querySelector('span');
                const messageElement = item.querySelector('small');
                
                const name = nameElement ? nameElement.textContent.toLowerCase() : '';
                const message = messageElement ? messageElement.textContent.toLowerCase() : '';
                
                // Show or hide based on search
                if (name.includes(searchText) || message.includes(searchText)) {
                    item.style.display = 'flex';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    }
    
    // Reset search when modal is closed
    const modalElement = document.getElementById('addNewChat');
    if (modalElement) {
        modalElement.addEventListener('hidden.bs.modal', function() {
            if (modalSearchInput) {
                modalSearchInput.value = '';
                
                // Show all items again
                const employeeItems = document.querySelectorAll('#modalEmployeeList .employeeList');
                employeeItems.forEach(item => {
                    item.style.display = 'flex';
                });
            }
        });
    }
});
</script>
    <div class="search-box-mob">
        <div class="close-search-bar">
            <img width="30" height="30" src="https://img.icons8.com/ios/30/close-window.png" alt="close-window" />
        </div>
        
        @push('custom-js')
<script>
    function makeid(length) {
    let result = '';
    const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    const charactersLength = characters.length;
    let counter = 0;
    while (counter < length) {
      result += characters.charAt(Math.floor(Math.random() * charactersLength));
      counter += 1;
    }
    return result;
}
        function getCurrentTime() {
            let now = new Date();
            let hours = now.getHours();
            let minutes = now.getMinutes();
            let ampm = hours >= 12 ? 'PM' : 'AM';

            hours = hours % 12 || 12; // Convert 24-hour format to 12-hour format
            hours = hours < 10 ? '0' + hours : hours; // Add leading zero to hours
            minutes = minutes < 10 ? '0' + minutes : minutes; // Add leading zero to minutes

            let timeString = hours + ':' + minutes + ' ' + ampm;

            return timeString;
        }
            $(document).ready(function(){
                function appendFileData(fileName, fileSize){
                    $('#selectedFile').append(`<i class="fa-solid fa-file display-4 mb-3"></i><span class="fs-4 fw-light ">${fileName}</span> <span class="fs-6 fw-bold ">Size : ${fileSize}</span>`);
                    return;
                }
                
            // $('.customEditor').on('input',function(event){
            //     $('#messageInput').val(messageInput)
            // })
            $('#selectFile').change(function(event){
                $('#selectedFile').html('')
                const ext = ['pdf','csv','excel','zipper','video','powerpoint'];
                
                var file = event.target.files[0]; // Get the selected file
                if (file) {
                    console.log(file)
                    var fileName = file.name; // Get file name
                    var fileExtension = fileName.split('.').pop().toLowerCase(); // Get file extension
                    var fileType = file.type; // Get MIME type
                    const fileSize = file.size < 1024 ? file.size + " Bytes" : file.size < 1024 * 1024 ? (file.size / 1024).toFixed(2) + " KB" : (file.size / (1024 * 1024)).toFixed(2) + " MB";

                    console.log(fileSize)
                    $('#selectedFile').removeClass('d-none')
                    appendFileData(fileName, fileSize);
                }
            })
            $('#sendMessage').submit(function(e){
                // var form = $(this);
                e.preventDefault(); 
                sendMessage($(this).find('input[name=message]').val())
            })
            const socket = io("https://live-chat-xzaw.onrender.com", {
                transports: ["polling", "websocket"]
            });


            let myUserId = {{$login_employee->id}};
    
            if (myUserId) {
                socket.emit("register", myUserId);
            }
            
            @if(isset($chat_with))
            function sendMessage(message) {
                const receiverId = {{$chat_with->id}};
                
                if (myUserId && receiverId && message) {
                    
let formData = new FormData();

// Append file
let file = $('input[name=file]')[0].files[0]; 
if (file) {
    formData.append('file', file);
}

// Serialize form inputs (excluding file)
let serializedData = $('form').serializeArray();
$.each(serializedData, function (index, field) {
    formData.append(field.name, field.value);
});
                    $.ajax({
                        type: "POST",
                        url: "{{url()->current()}}",
                        data: formData, // serializes the form's elements.
                        contentType: false, 
                        processData: false, 
                        beforeSend: function() {
                                $('#selectedFile').addClass('d-none')
                                $('#selectedFile').html('')
                                if(file){
                                    selfAppendMessage(message,'start',receiverId,file.name);
                                }else{
                                    socket.emit("private message", {
                        senderId: myUserId,
                        receiverId: receiverId,
                        message: message
                    });
                                    selfAppendMessage(message,'start',receiverId);
                                }
                        },
                        xhr: function () {
                        let xhr = new window.XMLHttpRequest();
                        xhr.upload.onprogress = function (event) {
                            if (event.lengthComputable) {
                                console.log(randomMakeId)
                                let percentComplete = Math.round((event.loaded / event.total) * 100)+'%';
                                $(`.file[data-uploadid=${randomMakeId}]`).find('.customProgress').attr('data-percentage',percentComplete)
                                $(`.file[data-uploadid=${randomMakeId}]`).find('.customProgress .innerCustomProgress').css({"width":percentComplete})
                            }
                            };
                            return xhr;
                        },
                        success: function(data)
                        {
                            if(file){
                                socket.emit("private message", {
                                    senderId: myUserId,
                                    receiverId: receiverId,
                                    message: message,
                                    other:{url:data.url , name:file.name}
                                });
                            }
                          
                          $(`.file[data-uploadid=${randomMakeId}]`).find('.actions .customProgress').remove()
                          $(`.file[data-uploadid=${randomMakeId}]`).find('.actions').append(`<a href="${data.url}" target="_blank" class="me-2"><i class="fa-solid fa-eye"></i></a><a href="${data.url}" download="240841_small.mp4"><i class="fa-solid fa-circle-down"></i></a>`)
                          $('#messageInput').val('')
                          $('input[name=file]').val(null)
                        }
                    });
                }
            }
            @endif
    
            socket.on("receive message", data => {
                console.log('receive message',data)
                appendMessage(data,'end');
            });
    
            function appendMessage(data,type) {
                let appendFile = (other) => {
                     return `<div class="file bg-dark-subtle text-dark rounded-3 rounded-bottom-0 position-relative">
                                                <i class="fa-solid fa-file display-6 mb-3"></i>
                                                <span class="fs-6 fw-light mb-2 px-3 text-center">${other.name}</span>
                                                <div class="actions position-relative">
                                                    <a href="${other.url}" target="_blank" class="me-2">
                                                        <i class="fa-solid fa-eye"></i>
                                                    </a>
                                                    <a href="${other.url}" download="${other.name}">
                                                        <i class="fa-solid fa-circle-down"></i>
                                                    </a>
                                                </div>
                                            </div>`
                }
                $(`.list-group-item[data-id=${data.senderId}]`).find('.profileContent small').text(data.message)
                $(`#remarks[data-id=${data.senderId}]`).prepend(`<div class="w-100 d-flex ${data.hasOwnProperty('other') != '' ? 'flex-column' : ''} justify-content-start mb-2 appendedMessage">
                                        ${data.hasOwnProperty('other') ? appendFile(data.other) : ''}
                                        <div class="mb-0 overflow-hidden text-${type == 'start' ? 'white' : 'dark'} rounded-3 ${data.hasOwnProperty('other') ? 'rounded-top-0 border-top w-100' : ''} text-wrap p-2 py-1 m-0 shadow-sm d-inline-block ${type == 'start' ? 'bg-dark' : 'bg-dark-subtle'}" style="max-width:50%;font-size:13px;word-break: break-all;">${data.message}</div>
                                    </div>`)
            }
            function selfAppendMessage(message,type,receiverId,name = '') {
                randomMakeId = makeid(10)
                let customProgress = (file_name) => {
                     return `<div class="file bg-dark text-white rounded-3 rounded-bottom-0 position-relative" data-uploadId="${randomMakeId}">
                                                <i class="fa-solid fa-file display-6 mb-3"></i>
                                                <span class="fs-6 fw-light mb-2 px-3 text-center">${name}</span>
                                                <div class="actions position-relative">
                                                    <div class="customProgress rounded-pill overflow-hidden" data-percentage="0%">
                                                        <div class="innerCustomProgress" style="width:0%">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>`
                };
                                            $(`.employeeList[data-id=${receiverId}]`).find('.profileContent small').text(message)
                                            $(`#remarks`).prepend(`<div class="w-100 d-flex flex-column align-items-end mb-2 appendedMessage">
                                        ${name != '' ? customProgress(name) : ''}
                                        <div class="mb-0 overflow-hidden text-white rounded-3 ${name != '' ? 'rounded-top-0 border-top w-100' : ''}   text-wrap p-2 py-1 m-0 shadow-sm d-inline-block bg-dark" style="max-width:50%;font-size:13px;word-break: break-all;">${message}<br><small class="float-end messageTime">${getCurrentTime()}</small></div>
                                        
                                    </div>`)
                                    
                const changePositionHtml = $(`#chattedEMpList .employeeList[data-id=${receiverId}]`).prop('outerHTML');
                $(`#chattedEMpList .employeeList[data-id=${receiverId}]`).remove()
                $(`#chattedEMpList ul`).prepend(changePositionHtml)
            }
            
            
        })
        
    </script>


        @endpush
        
    @endsection
