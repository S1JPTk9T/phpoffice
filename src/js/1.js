function showSheet(response) {
    let destination = document.querySelector("#embedsheet");
    let table = document.createElement("table");
        table.id="tabela";
    let clear = [
        function () {
           let oldtable = document.querySelector("#"+table.id);
           if(oldtable) {
               destination.removeChild(oldtable);
            };
          }
      ].map(n=> {n(); });

    try{
      let sheet = JSON.parse(this.responseText);
      sheet.map(line=> {
          let tr = document.createElement("tr");
          line.map(cell=> {
                  let td = document.createElement("td");
                  let text = document.createTextNode(cell);
                  td.append(text);
                  tr.append(td);
              });

              table.append(tr);
          });
          destination.appendChild(table);
    }catch(e) {alert(e); };
};

var enviar=()=> {
   let ElementForm = document.forms[0];
   let form = new FormData(ElementForm);
   let xhr = new XMLHttpRequest();
   xhr.onload=showSheet;
   xhr.open(ElementForm.method,ElementForm.action,true);
   xhr.send(form);

  };
