document.getElementById("im_btn").onclick = function() {
    document.getElementById("im_modal").style.display = "block";
}

document.getElementById("im_close").onclick = function() {
    document.getElementById("im_modal").style.display = "none";
}

function open_modal_ex(id, name, price) {
    document.getElementById("ex_modal").style.display = "block";
    document.getElementById("lot_id").value = id;
    document.getElementById("show_id").value = id;
    document.getElementById("show_name").value = name;
    document.getElementById("show_price").value = price;
}

document.getElementById("ex_close").onclick = function() {
    document.getElementById("ex_modal").style.display = "none";
}

document.getElementById("add_btn").onclick = function() {
    document.getElementById("add_modal").style.display = "block";
}

document.getElementById("add_close").onclick = function() {
    document.getElementById("add_modal").style.display = "none";
}