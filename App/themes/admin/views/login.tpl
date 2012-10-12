{extends file='layout.admin.tpl'}

{block name=content}
    <div class="row-fluid">
        <div class="span12">
            <div class="utopia-login-message">
                <h1>{$page.title}</h1>
            </div>
        </div>
    </div>

    <div class="row-fluid">

        <div class="span12">

            <div class="row-fluid">

                <div class="span6">
                    <div class="utopia-login-info">
                        <img src="{theme_url('/img/login.png')}" alt="Login">
                    </div>

                </div>

                <div class="span6">
                    <div class="utopia-login">
                        <h1>{$page.title}</h1>
                        <form action="dashboard.html" method="post" class="utopia">
                            <label>Username:</label>
                            <input type="text" value="Admin" class="span12 utopia-fluid-input validate[required]">

                            <label>Password:</label>
                            <input type="password" class="span12 utopia-fluid-input validate[required]" value="Password">

                            <ul class="utopia-login-action">
                                <li>
                                    <input type="submit" class="btn span4" value="Login">
                                    <div class="pull-right"><input type="checkbox" name="remember_me" value="yes"> Remember me!</div>
                                </li>
                            </ul>

                            <label><a href="#">Can't access your account?</a></label>
                        </form>
                    </div>
                </div>

            </div>

        </div>
    </div>
{/block}