 @foreach($user_data as $follow_user)
    
<?php $follow_array = explode(',', $follow_user->followid); ?>
        <div class="flex items-center justify-between py-3">
            <div class="flex flex-1 items-center space-x-4">
                <a href="profile.html">
                    <img src="{{asset('assets/images/avatars/avatar-2.jpg')}}" class="bg-gray-200 rounded-full w-10 h-10">
                </a>
                <div class="flex flex-col">
                    <span class="block capitalize font-semibold"> Johnson smith </span>
                    <span class="block capitalize text-sm"> Australia </span>
                </div>
            </div>
            
        <?php if(in_array(Session::get('user_id'),$follow_array)) { ?>
            <a href="javascript:void(0)" class="border border-gray-200 font-semibold px-4 py-1 rounded-full hover:bg-pink-600 hover:text-white hover:border-pink-600 dark:border-gray-800 sendreq" data-id="{{$follow_user->id}}"> Following </a>
        <?php } else { ?>
            <a href="javascript:void(0)" class="border border-gray-200 font-semibold px-4 py-1 rounded-full hover:bg-pink-600 hover:text-white hover:border-pink-600 dark:border-gray-800 sendreq" data-id="{{$follow_user->id}}"> Follow </a>
        <?php } ?>

        </div>
@endforeach