function showFormAttributeCreate() {

    var form = document.getElementById('formAttr');

    if (form.style.display == "block") {
        form.style.display = 'none';
    } else {
        form.style.display = 'block';
    }
}



function ajaxAttrib() {
    var formData = $('#formAttrCreate').serialize();
    $.ajax({
        url:'/contact/index/saveAttrib/ajax/true',
        dataType:'json',
        type:'POST',
        data:formData,
        success:function(data) {
            $('#closeBtn').trigger('click');
            $('#form_create .form-group').last().after(data.html);
            console.log(data);
        }
    });
    console.log(formData);

}

/** wrap ajax to form **/
function doneajax(response) {
    //console.log(this.response);
    var json = JSON.parse(response);
    var wrapForm = document.getElementById('js-wrapper');
    var wrapper = document.createElement('input');
    wrapper.setAttribute('type','text');
    wrapper.setAttribute('name','attrib['+json.id+']');
    wrapper.setAttribute('placeholder',json.place);
    var name = document.createTextNode(json.name+':');
    wrapForm.appendChild(name);
    wrapForm.appendChild(wrapper);
    alert(json.message);
}

function _getSelectedType() {
    var type = document.getElementById("type_input");
    var inputIndex = type.options[type.selectedIndex].value;
    console.log(inputIndex);
    return inputIndex;
}