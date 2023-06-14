<?php
include('../includes/db.php');
$action = $_POST['action'];

if ($action === 'fetch') {
    fetchExpenses();
} elseif ($action === 'add') {
    $description = $_POST['description'];
    $amount = $_POST['amount'];
    addExpense($description, $amount);
} elseif ($action === 'update') {
    $id = $_POST['id'];
    $date = $_POST['date'];
    $description = $_POST['description'];
    $amount = $_POST['amount'];
    updateExpense($id,$description, $amount);
} elseif ($action === 'delete') {
    $id = $_POST['id'];
    deleteExpense($id);
}
//Functions
function fetchExpenses()
{
    global $pdo;
    $query = $pdo->prepare("SELECT * FROM crud");
    $query->execute();
    $db_rows = $query->fetchAll(PDO::FETCH_ASSOC);

    $output = '';
    foreach ($db_rows as $row) {
        $output .= "
      <tr data-id='{$row['id']}' data-description='{$row['item']}' data-amount='{$row['price']}'>
        <td>{$row['item']}</td>
        <td>{$row['price']}</td>
        <td>
          <button type='button' class='btn btn-primary edit-expense'>Edit</button>
          <button type='button' class='btn btn-danger delete-expense'>Delete</button>
        </td>
      </tr>";
    }

    echo $output;
}
//Add Functions ,Increase Parameter Equals to Input
function addExpense($description, $amount) {
  global $pdo;
  $query = $pdo->prepare("INSERT INTO crud (item, price) VALUES (?, ?)");
  $query->execute([$description, $amount]);
}

function updateExpense($id, $description, $amount) {
  global $pdo;
  $query = $pdo->prepare("UPDATE crud SET item= ?, price = ? WHERE id = ?");
  $query->execute([$description, $amount, $id]);
}

function deleteExpense($id) {
  global $pdo;
  $query = $pdo->prepare("DELETE FROM crud WHERE id = ?");
  $query->execute([$id]);
}
