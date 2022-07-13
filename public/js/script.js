$(document).ready(function () {
    $('#sort').on('change', function () {
        var url = $(this).val();
        if (url) {
            window.location = url;
        }
        return false;
    })
});
function showprice(a) {
    var value = document.getElementById("getprice").value;
    var max = document.getElementById('stock' + value).value;
    
    // if(isset(a[value])){
    //     document.getElementById('pricesale').innerHTML=a[value]['pricesale'];
    // }
    var bill='';
    for (let i = 0; i < a.length; i++) {
        if(a[i]['product_detail_id']==value){
            bill = new Intl.NumberFormat('it-IT', { style: 'currency', currency: 'VND' }).format(a[i]['price_sale']);
        }
    }if(bill==''){
        document.getElementById('pricesale').innerHTML='';
        document.getElementById('price').innerHTML = document.getElementById('price' + value).value;
    }else{
        document.getElementById('pricesale').innerHTML=document.getElementById('price' + value).value;
        document.getElementById('price').innerHTML = bill;
    }
    
    // document.getElementById('price').innerHTML = document.getElementById('price' + value).value;
    
    document.getElementById("quantity").max = max;
};

function cartquantity(id) {
    var price = document.getElementById('price' + id).value;
    var quantity = document.getElementById('quantity' + id).value;
    a = price * quantity;
    total = new Intl.NumberFormat('it-IT', { style: 'currency', currency: 'VND' }).format(a);
    document.getElementById('total' + id).innerHTML = total;
    document.getElementById('ttotal' + id).value = a;

    var total1 = 0;
    var x = document.getElementsByClassName("total");
    var i;
    for (i = 0; i < x.length; i++) {
        total1 = total1 + parseInt(x[i].value);

    }
    bill = new Intl.NumberFormat('it-IT', { style: 'currency', currency: 'VND' }).format(total1);
    document.getElementById('total').innerHTML = bill;
};

function hidecapacity(a) {
    var idproduct = document.getElementById("idproduct").value;
    var x = document.getElementById('capacity');
    $('#capacity').empty();
    if (idproduct != '') {
        for (let i = 0; i < a.length; i++) {
            if (a[i]['product_id'] == idproduct) {
                // var html = '<option value="' + a[i]['id'] + '">' + a[i]['capacity'] + '</option>';
                // document.getElementById('capacity').innerHTML = html;
                var option = document.createElement("option");
                option.value = a[i]['id'];
                option.text = a[i]['capacity']; console.log(option.value);
                x.add(option);
            }
        }
    }
};
