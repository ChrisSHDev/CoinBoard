<form action="" method="post">
  <input type="hidden" name="tag[id]" value="<?php echo $tag['id'] ?? ''; ?>">
  <label for="tagname">Tag Name: </label>
  <input type="text" id="tagname" name="tag[name]" value="<?php echo $tag['name'] ?? '' ?>">
  <input type="submit" name="submit" value="Save">
</form>