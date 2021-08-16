$("#search").on('click', (e)=>{
  $(e.target).attr('disabled',true);
  let searchParam = $("#search-input-box").val();
  let csrf_token = $("meta[name='csrf-token']").attr('content');

  $.ajax({
    url: '/search-user',
    method: "POST",
    data: {
      "searchParam": searchParam,
      "_token":csrf_token
    },
    success: function(data){
      console.log("Success: ",data);
      if(data.length)
      {
        let temp = '<div class="row justify-content-center mt-3">';
        for(let i=0; i<data.length; i++)
        {
          temp += `<div class="col-md-8 mb-3">
                    <div class="card">
                      <div class="card-body d-flex justify-content-between align-items-center">
                        <span class="text-dark">${data[i].name}</span>
                        <a href="${window.location.origin}/view-profile/${data[i].id}" class="btn btn-sm btn-primary">View Profile</a>
                      </div>
                    </div>
                  </div>`;
        }
        temp += "</div>"
        $("#search-result").html(temp);
      }
      else
      {
        let temp = "Sorry! no result found.";
        $("#search-result").css({"color":"black", "margin-top":"20px", "text-align":"center"})
        $("#search-result").html(temp);
      }
      $(e.target).attr('disabled',false);
    },
    error: function(err){
      console.log("Err: ", err);
      $(e.target).attr('disabled',false);
    }
  })
})