<nav id="dashboard-nav">
    <div id="nav-container">
        <div id="dashboard-search">

            <div class="login-input input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1"><span class="oi oi-magnifying-glass"></span></span>
                </div>
                <input name="search" type="text" class="form-control" placeholder="Search" aria-label="email" aria-describedby="basic-addon1">

            </div>

        </div>
        <div id="dashboard-options">
            <div class="dash-option" id="dash-op-add">
                <div class="dash-drop-cont">
                    <span class="oi oi-plus"></span>
                    <div class="dash-drop">hi there</div>
                </div>
            </div>
            <div class="dash-option">
                <div class="dash-drop-cont">
                    <span class="oi oi-bell"></span>
                    <div class="dash-drop">hi there</div>
                </div>
            </div>
            <div class="dash-option">
                <div class="dash-drop-cont">
                    <span class="oi oi-heart"></span>
                    <div class="dash-drop">hi there</div>
                </div>
            </div>
            
            <div class="dash-option" id="dash-op-user">
                <div class="dash-drop-cont"> 
                    <img id="dash-user-icon" src="{{asset('/Images/user.svg')}}" alt="" srcset="">
                    <p id="dash-user-name" class="">{{auth()->user()->name}}</p>
                    <div class="dash-drop dash-op-user">
                        <div class="dash-drop-op-list-item">
                            <span class="oi oi-person"></span>
                            <button>Profile</button>
                        </div>
                        <div class="dash-drop-op-list-item">
                            <span class="oi oi-account-logout"></span>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button>Logout</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</nav>