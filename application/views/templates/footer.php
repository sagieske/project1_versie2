<div data-role="footer" class="ui-bar" align="center" data-position="fixed">
    <div data-role="controlgroup" data-type="horizontal">
        <!-- Note these links don't work when at appstudio_project1/pages/ -->
        <a href="../../pages" data-role="button" data-icon="home" data-iconpos="notext">Home</a>
        <a href="../../lists/show_all" data-role="button" data-icon="grid" data-iconpos="notext">List</a>
        <a href="../../search" data-role="button" data-icon="search" data-iconpos="notext">Search</a>
        <a href="../../lists/recently_viewed" data-role="button"  data-icon="star" data-iconpos="notext">Recently Viewed</a>
    </div>

<?              
                //Login notification here: 
                //echo '<P>';
                $li = $this->session->userdata('logged_in');
                if ( $li == 1 ) {
                    echo 'You are logged in, '.$this->session->userdata('username').'.';
                } 
                else { echo 'You are not logged in.'; } 
                //echo '</P>';
                // TODO Print is all weird?
?>

    <br><strong>&copy; Arjen Swellengrebel en Sharon Gieske 2012</strong>
</div>
</div>

</body>
</html>
