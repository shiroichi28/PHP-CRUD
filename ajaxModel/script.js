$(document).ready(function () {
  // Load expenses
  loadExpenses();

  // Submit expense form
  $("#expenseForm").submit(function (event) {
    event.preventDefault();
    var action = $("#expenseModal").data("action");
    if (action === "add") {
      addExpense();
    } else if (action === "edit") {
      updateExpense();
    }
  });

  // Open expense modal for adding
  $("#expenseModal").on("show.bs.modal", function (event) {
    var modal = $(this);
    modal.find(".modal-title").text("Add Expense");
    modal.find("#expenseId").val("0");
    modal.find("#expenseDescription").val("");
    modal.find("#expenseAmount").val("");
    modal.data("action", "add");
  });

  // Open expense modal for editing
  $("#expenseList").on("click", ".edit-expense", function () {
    var modal = $("#expenseModal");
    modal.modal("show");
    var row = $(this).closest("tr");
    modal.find(".modal-title").text("Edit Expense");
    modal.find("#expenseId").val(row.data("id"));
    modal.find("#expenseDescription").val(row.data("description"));
    modal.find("#expenseAmount").val(row.data("amount"));
    modal.data("action", "edit");
    
  });

  // Delete expense
  $("#expenseList").on("click", ".delete-expense", function () {
    var row = $(this).closest("tr");
    var expenseId = row.data("id");
    deleteExpense(expenseId);
  });
});

// Load expenses
function loadExpenses() {
  $.ajax({
    url: "ajax_action.php",
    type: "post",
    data: { action: "fetch" },
    success: function (response) {
      $("#expenseList").html(response);
    },
  });
}

// Add expense
function addExpense() {
  var description = $("#expenseDescription").val();
  var amount = $("#expenseAmount").val();

  $.ajax({
    url: "ajax_action.php",
    type: "post",
    data: {
      action: "add",
      description: description,
      amount: amount,
    },
    success: function () {
      $("#expenseModal").modal("hide");
      loadExpenses();
    },
  });
}

// Update expense
function updateExpense() {
  var expenseId = $("#expenseId").val();
  var description = $("#expenseDescription").val();
  var amount = $("#expenseAmount").val();

  $.ajax({
    url: "ajax_action.php",
    type: "post",
    data: {
      action: "update",
      id: expenseId,
      description: description,
      amount: amount,
    },
    success: function () {
      $("#expenseModal").modal("hide");
      loadExpenses();
    },
  });
}

// Delete expense
function deleteExpense(expenseId) {
  if (confirm("Are you sure you want to delete this expense?")) {
    $.ajax({
      url: "ajax_action.php",
      type: "post",
      data: { action: "delete", id: expenseId },
      success: function () {
        loadExpenses();
      },
    });
  }
}
