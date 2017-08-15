//--------------------

 function getPOInfo(id){
    $.ajax({
      method: 'GET',
      url:'/getPOInfo/'+id,
      success:function(response){
        response.map(function(item){
            // $('.cod').val(item.cod);
            // $('.isPay').val(item.isPayment);
            // $('.vat').val(item.vat);
            // $('.diposit').val(item.diposit);
        });
      },
      error:function(error){
        console.log(error);
      }
    });
  }
//-----------------------------------------------------------------------------------
function getValueCombo(id,ul,f)
{
   $.ajax({
    method: 'GET',
      url: ul+id,
      success:function(response){
        if(Array.isArray(response)){

            $(f).empty();
            var serialnumber="<option value=''>---Please select option---</option>";
            $(f).append(serialnumber);
            response.map(function(item){
              console.log(item.name);
              serialnumber="<option value=" + item.id + ">" + item.name + "</option>";;
              $(f).append(serialnumber);
            });
        }
      },
      error:function(error){
        console.log(error);
      }
   })
};
 //---------------------------
