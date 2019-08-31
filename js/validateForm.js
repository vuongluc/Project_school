
$.validator.setDefaults({
    submitHandler: function() {
        alert("You have successfully booked a tour!").window.history.go();
    }
});
$(document).ready(function() {

 
    $("#vForm").validate({
        rules: {
            name: {
                required: true,
                minlength: 2
               
            },
            phone: {
                required: true,
                minlength: 10
            },
            email: {
                required: true,
                email: true
            },
            address :"required",
            adult: {
                required: true,
                min: 1
            },
           
            children: {
                required:true,
                min: 0
            },
            card: {
                required: true,
                maxlength: 1
            },
            quantity: {
                required:true,
                min: 0
            },
            vehicle: "required",
            account: {
                required: true,
                
                minlength: 12,
                maxlength: 16
            },

            dep: {
                required: true
            }
            

        },
        messages: {
            name: {
               required: "Please enter your Name",
               minlength: "Name at least 2 characters"
                              
            },
            phone: {
                required: "Please enter your phone number",
                minlength: "At least 10 digits"
            },
            email: {
                required: "Please enter a Email",
                email: "Please enter the correct email format"
            },
            address: "Please enter Address",
            adult: {
                required: "Please enter the number of adults",
                minlength: "the number of adults is at least 1 person"
            },
            children: {
                required: "Please enter the number of children",
                min: "The number of young people is at least 0"

            },
            card : {
                required: "Choose a form of payment",
                maxlength: "Only one check box can be selected"
            },
            quantity: {
                require: "Please enter the vehicle number",
                min: "Minimum number of vehicles 1"
            },
            vehicle: "Please select a vehicle",
            account: {
                required: "Please enter the account number",
               
                minlength: "Minimum 12-digit account number",
                maxlength: "Account number up to 16 digits"
            },
            dep: "Please enter the deposit amount"
        }
    });

    

});