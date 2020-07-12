var xhttp;
if (window.XMLHttpRequest) {
    xhttp = new XMLHttpRequest();
    } else {
    xhttp = new ActiveXObject("Microsoft.XMLHTTP");
}

function get_departments(course_id){
  xhttp.open("GET", "get_unallocated_departments/"+course_id, false);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send();

    if(xhttp.status == 200){
        return xhttp.responseText;
    }
}

function processData(json_data,select_element_id){

    function generate_option(department_data){
        let option = document.createElement('option');
            for(let key in department_data){
                option.setAttribute('value',key);
                option.innerHTML = department_data[key];
            }
            return option;
    }

    try{
        let array_to_use = JSON.parse(json_data);
        let dep_array = array_to_use.departments;

        let parentSelect = document.getElementById(select_element_id);
        parentSelect.innerHTML = '';


        //loop through each department
        for(let i = 0; i < dep_array.length; i++) {
        // attach generated option to the parent:Select
        parentSelect.appendChild(generate_option(dep_array[i]));

        }
    }catch(err){
        console.log(err.message);
    }
}
