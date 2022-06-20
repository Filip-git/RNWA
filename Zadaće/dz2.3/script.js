const search_text = document.querySelector("#search_text");

async function showHint(str) {
  if (str.length == 0) {
    document.getElementById("result").innerHTML = "";
    return;
  } else {
      await axios.get("employees_search.php",{params :{s:str}} )
        .then((response)=>{
          document.getElementById("result").innerHTML = response.data;
          // console.log(response.data);
        });
  }
}
search_text.addEventListener("keyup", ()=>{
   showHint(search_text.value);
  
});