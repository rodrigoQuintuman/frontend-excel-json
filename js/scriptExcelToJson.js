let selectedFile;
console.log(window.XLSX);

let rowObject;
let data = [{}];

document.getElementById("inputFile").addEventListener("change", (event) => {
  selectedFile = event.target.files[0];

  let fileInput = document.getElementById('inputFile');
  let filePath = fileInput.value;
  let allowedExtensions = /(\.xlsx|\.xls)$/i;
      
  if (!allowedExtensions.exec(filePath)) {
      Swal.fire({
        title: "Archivo no válido",
        confirmButtonText: "Aceptar",
      });
      fileInput.value = '';    
      document.getElementById("jsonData").innerHTML = "";
      rowObject = undefined;
      
  }else{
    XLSX.utils.json_to_sheet(data);
    console.log(selectedFile);
    if (selectedFile) {
      let fileReader = new FileReader();
      fileReader.readAsBinaryString(selectedFile);
      fileReader.onload = (event) => {
        let data = event.target.result;
        let workbook = XLSX.read(data, { type: "binary" });
        workbook.SheetNames.forEach((sheet) => {
          rowObject = XLSX.utils.sheet_to_row_object_array(workbook.Sheets[sheet]);
          rowObject.forEach(function (value) {
            console.log(value.Username);
            if((typeof value.Username) == "string"){
              if( !value.Username.includes("@")){
                value.Username = value.Username.split('.').join('');
                value.Username = value.Username.split('-').join('');
                value.Username = value.Username.split(',').join('');
                value.Username = value.Username.split(' ').join('');
              }else{
                value.Username = value.Username.split(' ').join('');
              }
            }
          });
          //var worksheet = workbook.Sheets[workbook.SheetNames[0]];
          document.getElementById("jsonData").innerHTML = JSON.stringify(rowObject,undefined,4);
        });
      };
    }
  }
});

document.getElementById("btnDownload").addEventListener("click", () => {
    const blob = new Blob([JSON.stringify(rowObject)], {type : 'application/json'});
    if(rowObject != undefined){
       saveAs(blob, 'planillaUsuarios.json');
    }
    
});

document.getElementById("btnGetFile").addEventListener("click", () => {
  location.href = "/files/PlanillaUsuarios.xlsx";
  
});
