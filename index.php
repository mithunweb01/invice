<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
<title>Invoice Billing</title>
<style>
body{font-family:Arial;background:#f4f6f8;padding:20px}
.box{background:#fff;padding:20px;border-radius:8px;max-width:1100px;margin:auto}
table{width:100%;border-collapse:collapse;margin-top:15px}
th,td{border:1px solid #ccc;padding:8px;text-align:center}
</style>
</head>
<body>

<div class="box">
<h2>Invoice Billing Software</h2>

<form method="post" action="add_to_cart.php">
Customer:
<input name="customer" required>

<select name="pid" required>
<option value="">Select Product</option>
<?php
$q=$conn->query("SELECT p.pid,p.pname,p.rate,s.qnt 
FROM products p JOIN stock s ON p.pid=s.pid");
while($r=$q->fetch_assoc()){
 echo "<option value='{$r['pid']}'>
 {$r['pname']} - ₹{$r['rate']} (Stock {$r['qnt']})
 </option>";
}
?>
</select>

Qty:
<input type="number" name="qty" min="1" required>
<button>Add</button>
</form>

<table>
<tr><th>#</th><th>Product</th><th>Rate</th><th>Qty</th><th>Amount</th></tr>
<?php
$total=0;
foreach($_SESSION['cart'] as $i=>$c){
$total+=$c['amt'];
echo "<tr>
<td>".($i+1)."</td>
<td>{$c['name']}</td>
<td>{$c['rate']}</td>
<td>{$c['qty']}</td>
<td>{$c['amt']}</td>
</tr>";
}
?>
</table>

<h3>Sub Total: ₹<?= $total ?></h3>
<h3>GST (18%): ₹<?= $gst=$total*0.18 ?></h3>
<h2>Grand Total: ₹<?= $total+$gst ?></h2>

<form method="post" action="save_invoice.php">
<input type="hidden" name="customer" value="">
<button>Save Invoice</button>
</form>

</div>
</body>
</html>
