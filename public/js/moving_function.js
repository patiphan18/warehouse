

document.getElementById("close_detail_modal").onclick = function() {
    document.getElementById("detail_modal").style.display = "none";
}

function open_detail_modal(id, name, qty, price) {
    document.getElementById("detail_modal").style.display = "block";
    document.getElementById("show_id").innerHTML = "เลขล็อต: " + id;
    document.getElementById("show_name").innerHTML = "ชื่อยา: " + name;
    document.getElementById("show_qty").innerHTML = "จำนวน: " + qty;
    document.getElementById("show_price").innerHTML = "ราคา: " + price;
}
