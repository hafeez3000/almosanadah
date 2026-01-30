<?php
if (isset($_POST['action']) && $_POST['action'] == 'submitted') {
   echo '<pre>';
   print_r($_POST);
   echo '<a href="'. $_SERVER['PHP_SELF'] .'">Please try again</a>';

   echo '</pre>';
?>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
  
   <input type="hidden" name="personal[name]" value="<? echo $_POST[personal][name] ?>" />
    <input type="hidden" name="personal[email]" value="<? echo $_POST[personal][email] ?>" />
   
   Age:  <input type="text" name="personal[age]" /><br />

   <input type="hidden" name="action" value="submitted" />
   <input type="submit" name="submit" value="submit me!" />
</form>
<?
} else {
?>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
   Name:  <input type="text" name="personal[name]" /><br />
   Email: <input type="text" name="personal[email]" /><br />
   Beer: <br />
   <select multiple name="beer[]">
       <option value="warthog">Warthog</option>
       <option value="guinness">Guinness</option>
       <option value="stuttgarter">Stuttgarter Schwabenbräu</option>
   </select><br />
   <input type="hidden" name="action" value="submitted" />
   <input type="submit" name="submit" value="submit me!" />
</form>
<?php
}
?> 