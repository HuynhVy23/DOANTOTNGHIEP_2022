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
// $("#btnpost").click(function(e){
    $("#formaddcart").on('submit',function(e){
    e.preventDefault();
    $.ajax({
        // url: "{{ route('cart.store') }}",
    //   type:"POST",
    //   data:{
    //     idproduct:idproduct,
    //     quantity:quantity,
    //     _token: _token
    //   },
    //   success:function(response){
    //     console.log(response);
    //     if(response) {
    //       $('#success').text(response.success);
    //       $("#ajaxform")[0].reset();
    //       alert('hi');
    //     }
    //   },
        url:$(this).attr('action'),
        type:$(this).attr('method'),
        data:new FormData(this),
        processData:false,
        dataType:'json',
        contentType:false,
        success:function(data){
            if(data.status==0){
                showfail();
            }else if(data.status==1){
                showsuccess();
            }else{
                window.location="http://127.0.0.1:8000/login";
            }
        }
    });
     
});
function showsuccess(){
    document.getElementById("successar").style.display = "flex";    
    // success;
    var x = setTimeout(()=>{
        document.getElementById("successar").style.display = "none"
    }, 3000);
}

function showfail(){
    document.getElementById("failar").style.display = "flex";    
    // fail;
    var x = setTimeout(()=>{
        document.getElementById("failar").style.display = "none"
    }, 3000);
}

function checkout(){
    document.getElementById("checkout").disabled=true;
    var x = setTimeout(()=>{
        document.getElementById("checkout").disabled = false;
    }, 5000);
}
var totalproduct=document.getElementById('totalproduct').value;
var i=0;
function deletecart(id){
    i+=1;
    $.ajax({
        type: "get",
        url: "cartd/"+id,
       
        data: {
            _token:document.getElementsByName('_token')[0].value,
        },
        dataType: "json",
        processData:false,
        contentType:false,
        success: function (data) {
            if(i<totalproduct){
                $('#cart'+id).remove();
            }else{
                window.location="http://127.0.0.1:8000/cart";
            }
                
        }
    });
}