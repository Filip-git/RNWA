const search_text = document.querySelector("#search_text");

async function showHint(str) {
  if (str.length == 0) {
    document.getElementById("result").innerHTML = "";
    return;
  } else {
    fetch('employees_search.php?' + new URLSearchParams({
      s:str
  }))
    .then(function(response) {
      if (response.status >= 200 && response.status < 300) {
        document.getElementById("result").innerHTML = response;
        return response.text()
      }
      throw new Error(response.statusText)
    })
    .then((response)=> {
      document.getElementById("result").innerHTML = response;
    })
          
          
  }
}
search_text.addEventListener("keyup", ()=>{
   showHint(search_text.value);
  
});
