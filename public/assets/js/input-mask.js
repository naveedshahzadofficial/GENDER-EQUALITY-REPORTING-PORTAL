// Class definition

var KTInputmask = function () {
    
    // Private functions
    var formMasking = function () {
        // date
        // $(".datepicker").inputmask("99-99-9999", {
        //     "placeholder": "dd-mm-yyyy"
        // });

        // Mobile number
        $(".mobile_no").inputmask("mask", {
            "mask": "99999999999",
			autoUnmask: false,
			greedy:true,
			insertMode:true,
			// placeholder: "03xxxxxxxxx"
        });
		// Phone number
		$(".phone_no").inputmask("mask", {
			"mask": "99999999999",
			// placeholder: "0xxxxxxxxxx"
		});
		$(".phone_no_code").inputmask("mask", {
			"mask": "999",
			// placeholder: "0xxxxxxxxxx"
		});
		$(".phone_no_dial").inputmask("mask", {
			"mask": "99999999",
			// placeholder: "0xxxxxxxxxx"
		});


		// CNIC Number
        $(".cnic_no").inputmask({
            "mask": "99999-9999999-9",
			autoUnmask: true,
            // placeholder: "xxxxx-xxxxxxx-x"
        });
        //email address
        $(".email_address").inputmask({
            mask: "*{1,20}[.*{1,20}][.*{1,20}][.*{1,20}]@*{1,20}[.*{2,6}][.*{1,2}]",
            greedy: false,
            onBeforePaste: function (pastedValue, opts) {
                pastedValue = pastedValue.toLowerCase();
                return pastedValue.replace("mailto:", "");
            },
            definitions: {
                '*': {
                    validator: "[0-9A-Za-z!#$%&'*+/=?^_`{|}~\-]",
                    cardinality: 1,
                    casing: "lower"
                }
            }
        });        
    }

    return {
        // public functions
        init: function() {
			formMasking();
        }
    };
}();

jQuery(document).ready(function() {
    KTInputmask.init();
});
