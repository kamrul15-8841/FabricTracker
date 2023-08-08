function Order_Form_Validation()
{


    if(document.getElementById("buyer_id").value.trim()=="")
    {
        alert("Please Provide buyer_id");
        document.getElementById("buyer_id").focus();
        return false;
    }

    if(document.getElementById("gd").value.trim()=="")
    {
        alert("Please Provide gd");
        document.getElementById("gd").focus();
        return false;
    }
    else if(document.getElementById("style").value.trim()=="")
    {
        alert("Please Provide Style Name");
        document.getElementById("style").focus();
        return false;
    }
    else if(document.getElementById("color").value.trim()=="")
    {
        alert("Please Provide Color Name");
        document.getElementById("color").focus();
        return false;
    }
    else if(document.getElementById("fabric_qty").value.trim()=="")
    {
        alert("Please Provide Contact Fabric Quantity");
        document.getElementById("fabric_qty").focus();
        return false;
    }
    else if(document.getElementById("fabric_type").value.trim()=="")
    {
        alert("Please Provide Fabric Type");
        document.getElementById("fabric_type").focus();
        return false;
    }else if(document.getElementById("weave_type").value.trim()=="")
    {
        alert("Please Provide Weave Type");
        document.getElementById("weave_type").focus();
        return false;
    }else if(document.getElementById("p_requirement").value.trim()=="")
    {
        alert("Please Provide Printing Requirement");
        document.getElementById("p_requirement").focus();
        return false;
    }else if(document.getElementById("p_finish").value.trim()=="")
    {
        alert("Please Provide Performance Finish");
        document.getElementById("p_requirement").focus();
        return false;
    }else if(document.getElementById("fabrics_booking_date").value.trim()=="")
    {
        alert("Please Provide Fabrics Booking Date");
        document.getElementById("fabrics_booking_date").focus();
        return false;
    }

    else if(document.getElementById("buyer_delivery_date").value.trim()=="")
    {
        alert("Please Provide Buyer Delivery Date");
        document.getElementById("buyer_delivery_date").focus();
        return false;
    }

    else if(document.getElementById("gd_creation_date").value.trim()=="")
    {
        alert("Please Provide GD Creation Date");
        document.getElementById("gd_creation_date").focus();
        return false;
    }else if(document.getElementById("lead_time").value.trim()=="")
    {
        alert("Please Provide Lead Time");
        document.getElementById("lead_time").focus();
        return false;
    }

}