var date = $('.fc-datepicker').datepicker({
        dateFormat: 'yy-mm-dd'
    }).val();

    function changetypeorder() {
        const orderTypselect = document.getElementById('orderTypselect').value,
        typeorder = document.querySelectorAll('#typeorder'),
        rdodivce = document.querySelectorAll('#rdodivce'),
        rdocar = document.querySelectorAll('#rdocar'),
        rdoall = document.querySelectorAll('#rdoall');
        /* rdoall1 = document.getElementById('rdoall1'),
        rdoall2 = document.getElementById('rdoall2'),
        rdoall3 = document.getElementById('rdoall3'),
        rdoall4 = document.getElementById('rdoall4'),
        rdoall5 = document.getElementById('rdoall5'); */
        if (orderTypselect == 1) {
            typeorder.forEach(e => {
                e.innerHTML = "أجهزة وأثاث منزلي";
            });
            rdoall.forEach(d =>{
                if (d.value == 3 || d.value == 4 || d.value == 5) {
                    d.style.display = "none";
                }
                if (d.value == 1 || d.value == 2) {
                    d.style.display = "block";
                } else {
                    d.style.display = "none";
                }
            });
        }else if(orderTypselect == 2){
            typeorder.forEach(e => {
                e.innerHTML = "سيارة";
            });
            rdoall.forEach(d => {
                d.style.display = "block";
            });
        }else{
            rdoall.forEach(d => {
                d.style.display = "none";
            });
        }
    }

    function changePeriod() {
        let orderTypselect = document.getElementById('orderTypselect').value,
        amount = document.getElementById('purchasingValue').value,
        installmentPeriod = document.getElementById('installmentPeriod');

        if (amount != null && installmentPeriod != null) {
            checkAmount();
        }
    }

    function checkAmount() {

        let amount = document.getElementById('purchasingValue'),  /* القيمة الشرائية */
        deductionsBox = document.getElementById('deductionsBox').value, /* الصندوق */
        deductionsHr = document.getElementById('deductionsHr').value,  /* شئون الموظفين */
        salary = document.getElementById('salary').value,  /* الراتب */
        orderTypselect = document.getElementById('orderTypselect').value, /* نوع الطلب */
        installmentPeriod = document.getElementById('installmentPeriod').value,  /* مدة التقسيط */
        finalRate =  document.getElementById('finalRate'), /* الناتج */
        /* attentionRate =  document.getElementById('attentionRate'), */  /* تنبيه الناتج */
        sponsor = document.getElementById('sponsor'),

        sumHrBox,sumDeductions , sumAmout , rate,rate2;

        sumHrBox = parseInt(deductionsBox) + parseInt(deductionsHr);

        if (deductionsBox == 0) {
            alert('الرجاء مراجعة شئون الموظفين');
            return false;
        }else{
            if (orderTypselect == 1) {
                if (amount.value > 30000) {
                    alert('يجيب ان لايزيد المبلغ عن 30000 ريال ');
                    amount.focus();
                    return false;
                }else{
                    if (installmentPeriod == 1) {
                    rate = parseInt(amount.value) * 0.1 ;
                    rate2 = (parseInt(amount.value) + rate)  /12;
                    sumDeductions = sumHrBox + rate2;
                    sumAmout = sumDeductions / salary * 100;
                    } else if (installmentPeriod == 2) {
                        rate = parseInt(amount.value) * 0.2 ;
                        rate2 = (parseInt(amount.value) + rate)  /24;
                        sumDeductions = sumHrBox + rate2;
                        sumAmout = sumDeductions / salary * 100;
                    }
                }

            } else if (orderTypselect == 2){
                if (installmentPeriod == 1) {
                    rate = parseInt(amount.value) * 0.5 ;
                    rate2 = (parseInt(amount.value) + rate)  /12;
                    sumDeductions = sumHrBox + rate2;
                    sumAmout = sumDeductions / salary * 100;
                } else if (installmentPeriod == 2) {
                    rate = parseInt(amount.value) * 0.10 ;
                    rate2 = (parseInt(amount.value) + rate)  /24;
                    sumDeductions = sumHrBox + rate2;
                    sumAmout = sumDeductions / salary * 100;
                }else if (installmentPeriod == 3) {
                    rate = parseInt(amount.value) * 0.15 ;
                    rate2 = (parseInt(amount.value) + rate)  /36;
                    sumDeductions = sumHrBox + rate2;
                    sumAmout = sumDeductions / salary * 100;
                }else if (installmentPeriod == 4) {
                    rate = parseInt(amount.value) * 0.25 ;
                    rate2 = (parseInt(amount.value) + rate)  /48;
                    sumDeductions = sumHrBox + rate2;
                    sumAmout = sumDeductions / salary * 100;
                }else if (installmentPeriod == 5) {
                    rate = parseInt(amount.value) * 0.25 ;
                    rate2 = (parseInt(amount.value) + rate)  /60;
                    sumDeductions = sumHrBox + rate2;
                    sumAmout = sumDeductions / salary * 100;

                }
            }
                finalRate.value = Math.round(sumAmout);
                if (Math.round(sumAmout) > 60) {
                    /* attentionRate.innerHTML = "عفواً هذه النسبة إعلى من 50%"; */
                    /* attentionRate.style.color =  "red"; */
                    /* sponsor.style.display= "block"; */
                    return false;
                    amount.focus();
                }
        }
    }

    function checkInput() {
        var sponsor = document.getElementById('sponsorId').value,
            finalRate = document.getElementById('finalRate').value;
            if (finalRate > 60) {
                alert('إجمالي نسبة الاستقطاع من الراتب إعلي من الحد المسموح به يجب تخفيض القيمة الشرائية');
        }
    }
    function showlink() {
        let check = document.getElementById('agree').checked,
            orderTypselect = document.getElementById('orderTypselect').value,
            amount = document.getElementById('purchasingValue'),
            savebtn = document.getElementById('savelink'),
            attention = document.getElementById('attention'),
            sponsor = document.getElementById('sponsorId').value,
            deductionsBox = document.getElementById('deductionsBox').value,
            finalRate = document.getElementById('finalRate').value;

            if (deductionsBox == 0) {
                alert('الرجاء مراجعة شئون الموظفين');
                return false;
            }else{
                if (check === true) {
                    if (orderTypselect == 1) {
                        if (amount.value > 30000) {
                            alert('يجيب ان لايزيد المبلغ عن 30000 ريال ');
                            amount.focus();
                            return false;
                        }
                    }
                    if (finalRate > 60) {
                        /* alert('إجمالي نسبة الاستقطاع من الراتب إعلي من الحد المسموح به يجب تخفيض القيمة الشرائية او إختيار كافل'); */
                        alert('إجمالي نسبة الاستقطاع من الراتب إعلي من الحد المسموح به يجب تخفيض القيمة الشرائية ');
                        check = false;
                    }else{
                        savebtn.style.display = "block";
                        attention.style.display = "block";
                    }
                } else {
                    savebtn.style.display = "none";
                    attention.style.display = "none";

                    /* alert(check); */
                }
            }

    }
    function validateForm() {
        /* let typeEnter = document.getElementById('typeEnter').value;

        if (typeEnter == 1) {
            alert('لديك طلب سابق سيتم التعديل عليه');
        } */
        checkInput();
    }


