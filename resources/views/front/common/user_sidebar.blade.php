@php
    $id = Auth::user()->id;
    $user = App\Models\User::find($id);
@endphp


<div class="col-md-2"><br>
    {{--<img class="card-img-top" style="border-radius: 50%"
         src="{{ (!empty($user->profile_photo_path))? url('upload/user_images/'.$user->profile_photo_path):asset('images/user/no-image.png') }}"
         height="100%" width="100%">--}}
    <div id="name" style="display: none;">{{ Auth::user()->name }}</div>
    <center>
        <div id="profileImage"></div>
        <br>
    </center>

    <ul class="list-group list-group-flush">
        <a href="{{ route('home') }}" class="btn btn-primary btn-sm btn-block">{{__('Home')}}</a>

        <a href="{{ route('user.profile') }}" class="btn btn-primary btn-sm btn-block">{{__('Profile Update')}}</a>

        <a href="{{ route('change.password') }}" class="btn btn-primary btn-sm btn-block">{{__('Change Password')}} </a>

        <a href="{{ route('my.orders') }}" class="btn btn-primary btn-sm btn-block">{{__('My Orders')}}</a>

        <a href="{{ route('return.order.list') }}"
           class="btn btn-primary btn-sm btn-block">{{__('Returned Orders')}}</a>

        <a href="{{ route('cancel.orders') }}" class="btn btn-primary btn-sm btn-block">{{__('Cancelled Orders')}}</a>
        <br>
        <form method="POST" class="mb-3" action="{{ route('logout') }}">
            <button class="btn btn-danger btn-sm btn-block">
                @csrf
                <x-jet-dropdown-link style="color: #FFF;" href="{{ route('logout') }}"
                                     onclick="event.preventDefault();
                                                this.closest('form').submit();">
                    <i class="icon fa fa-sign-out"></i> {{ __('Log Out') }}
                </x-jet-dropdown-link>
            </button>
        </form>

    </ul>

</div> <!-- // end col md 2 -->
