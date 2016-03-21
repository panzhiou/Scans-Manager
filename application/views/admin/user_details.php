<li class="user-details cyan darken-2">
            <div class="row">
                <div class="col col s4 m4 l4">
                    <img src="" alt="" class="circle responsive-img valign profile-image">
                </div>
                <div class="col col s8 m8 l8">
                    <ul id="profile-dropdown" class="dropdown-content">
                        <li><a href="#soon">Profile</a></li>
                        <li class="divider"></li>
                        <li><a href="<?=base_url("auth/logout");?>">Logout</a></li>
                    </ul>
                    <a class="btn-flat dropdown-button waves-effect waves-light white-text profile-btn" href="#" data-activates="profile-dropdown"><?=$login_username?><i class="mdi-navigation-arrow-drop-down right"></i></a>
                    <!--<p class="user-roal">Administrator</p>-->
                </div>
            </div>
</li>