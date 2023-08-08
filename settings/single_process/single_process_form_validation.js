

function Event_wise_buyer_Form_Validation()

{
    if(document.getElementById("buyer_id").value.trim()=="")
    {
        alert("Please Provide buyer Name");
        document.getElementById("buyer_id").focus();
        return false;
    }

    else if(document.getElementById("fabric_type").value.trim()=="")
    {
        alert("Please Select Process Type");
        document.getElementById("fabric_type").focus();
        return false;
    }

    else if(document.getElementById("weave_type").value.trim()=="")
    {
        alert("Please Select events");
        document.getElementById("weave_type").focus();
        return false;
    }

    else if(document.getElementById("p_requirement").value.trim()=="")
    {
        alert("Please Select events");
        document.getElementById("p_requirement").focus();
        return false;
    }

    else if(document.getElementById("multi_events").value.trim()=="")
    {
        alert("Please Select events");
        document.getElementById("multi_events").focus();
        return false;
    }

    else if(document.getElementById("day_before_delivary").value.trim()=="")
    {
        alert("Please Select day_before_delivary");
        document.getElementById("day_before_delivary").focus();
        return false;
    }

}