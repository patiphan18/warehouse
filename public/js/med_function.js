document.getElementById("add_btn").onclick = function() {
    document.getElementById("add_modal").style.display = "block";
}

document.getElementById("add_close").onclick = function() {
    document.getElementById("add_modal").style.display = "none";
    document.getElementById("med_type").value = "";
    document.getElementById("med_code").value = "";
    document.getElementById("med_name").value = "";
    document.getElementById("med_price").value = "";
    document.getElementById("med_img").setAttribute("src", "");
    document.getElementById("med_img").value = "";    

    let img = document.getElementById('img');
    img.src = "";
    img.style.display = "none";
    
    document.getElementById('img_text').innerHTML = "ภาพยา";
}

var show_img = function(event) {
    var img = document.getElementById('img');
    img.style.display = "block";
    document.getElementById('img_text').innerHTML = "";
    img.src = URL.createObjectURL(event.target.files[0]);
    img.onload = function() {
        URL.revokeObjectURL(output.src)
    }
};

document.getElementById("edit_btn").onclick = function() {
    document.getElementById("edit_modal").style.display = "block";
}

document.getElementById("edit_close").onclick = function() {
    document.getElementById("edit_modal").style.display = "none";
}
