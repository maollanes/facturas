function validateSelectCap(theId) {
  if(document.getElementById('slt_fecha').value == ''){
    alert('Debe seleccionar una Fecha.'); return(false);
  }           
  return(true);
}