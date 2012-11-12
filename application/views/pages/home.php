
<h2> This is the home screen. </h2>
<p> You can click on the links below to see other pages.</p>
    
    <?
    $li = $this->session->userdata('logged_in');
    if ( !$li ) { ?>
    <form action="pages" method="post" data-inline="true">
    <fieldset data-role="controlgroup" >
        <label for="explanation">And you can login now:</label>
        <input type="text" name="un" id="un">
        <input type="text" name="pw" id="pw">
        <input type="submit" value="Login!" data-inline="true" id="login">
    </fieldset>
    </form>
    
    <form action="pages/view_signup" method="post" data-inline="true">
    <fieldset data-role="controlgroup" >
        <label for="explain">If you don't have an account yet, you can sign up right here:</label>
        <input type="submit" value="Sign up!" data-inline="true" id="login">
    </fieldset>
    </form>
    <? } else { ?>
    
    <form action="pages/view_logout" method="post" data-inline="true">
    <fieldset data-role="controlgroup" >
        <input type="submit" value="Logout!" data-inline="true" id="login">
    </fieldset>
    </form>
    
    <? } ?>

