<?php
  // ini_set('display_errors', 1);
  // ini_set('display_startup_errors', 1);
  // error_reporting(E_ALL);

  $jsonData = file_get_contents("data.json");
  $data = json_decode($jsonData, true);

  // here we go
  if(isset($_POST['item_key']) && !empty($_POST['item_key'])) {
    $data = array_values($data);
    $i=0;
    foreach($data as $element) {
      //check if it's the right item
      if(intval($_POST['item_key']) == $element['id']){ // intval only if you are sure id passed in POST[item_key] always integer 
         unset($data[$i]);
      }
      $i++;
   }
    file_put_contents('data.json', json_encode(array_values($data)));
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>test</title>
</head>
<body>
<table class="table">
    <thead class="thead-dark">
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Nazwa</th>
            <th scope="col">Cena</th>
            <th scope="col">Kupujący</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($data as $key =>
        $value): ?>
        <tr>
            <td><?php echo $value['id']; ?></td>
            <td><?php echo $value['name']; ?></td>
            <td><?php echo $value['price']; ?></td>
            <td><?php echo $value['buyer']; ?></td>
            <td>
                <!-- action="#" means you will stay in the same script after submit -->
                <form action="#" method="POST">
                    <input
                        hidden
                        type="text"
                        name="item_key"
                        value="<?php echo $value['id'];?>"
                    />
                    <input type="submit" value="Remove" />
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

</body>
</html>
