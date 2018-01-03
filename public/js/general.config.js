function initPicker() {
  var picker = new FilePicker({
    apiKey: 'AIzaSyCxQ1OXoUZBqgFtFsuTO2a4G1mlcGRCP1g',
    clientId: '795001262914-nkq9vjsd7427n52i2htpkeip1ocsj59h.apps.googleusercontent.com',
    
    buttonEl: document.getElementById('pick'),
    onSelect: function(file) {
      //console.log(file);
      $('.google-list').append('<div class="eachgooglelist"><i class="glyphicon glyphicon-trash remove-doc"></i> <a href="'+file.alternateLink+'" target="_blank">'+file.title+'</a> <input type="hidden" name="google_doc_name[]" value="'+file.title+'"  /> <input type="hidden" name="google_doc_link[]" value="'+file.alternateLink+'"  /></div>');
    }
  }); 
}