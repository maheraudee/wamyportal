function calc() {
    let sprAvilb = document.getElementById('sprAvilb').value,       /* وجود كافل */
        empendService = document.getElementById('empendService').value,    /* نهاية خدمة الموظف */
        empbalancebox = document.getElementById('empbalancebox').value,     /* رصيد الصندوق للموظف */
        emptotalGuarantees = document.getElementById('emptotalGuarantees'),     /* إجمالي الضمانات للموظف */
        empdebtFurniture = document.getElementById('empdebtFurniture').value,   /* مديونية الاثاث للموظف */
        empdebtCar = document.getElementById('empdebtCar').value,               /* مديونية السيارات للموظف */
        empanothSponosr = document.getElementById('empanothSponosr').value, /* كفالة موظف اخر للموظف */
        totalCommitmentEmp = document.getElementById('totalCommitmentEmp'),         /* إجمالي الالتزامات للموظف */
        guaranteesAvailableEmp = document.getElementById('guaranteesAvailableEmp'),   /* الضمانات المتاحة  الموظف*/


        totalGuaranteesAll = document.getElementById('totalGuaranteesAll'),     /* إجمالي الضمانات */
        totalCommitmentAll = document.getElementById('totalCommitmentAll'),     /* إجمالي الالتزامات */
        guaranteesAvailableAll = document.getElementById('guaranteesAvailableAll'),   /* الضمانات المتاحة */

        purchasingValueGurnt = document.getElementById('purchasingValueGurnt'), /* مبلغ الضمان المطلوب */
        purchasingValue = document.getElementById('purchasingValue'),           /* القيمة الشرائية */

        aprovalSponsor  = document.getElementById('aprovalSponsor'), /* موافقة الكافل */
        garntealert  = document.getElementById('garntealert'); /* رسالة الخطأ */
        /* empendService */

        emptotalGuarantees.value = parseFloat(empendService) + parseFloat(empbalancebox); /* ناتج إجمالي الضمانات للموظف */
        totalCommitmentEmp.value = parseFloat(empdebtFurniture) + parseFloat(empdebtCar) + parseFloat(empanothSponosr);  /* ناتج إجمالي الإلتزامات للموظف*/
        guaranteesAvailableEmp.value = parseFloat(emptotalGuarantees.value) - parseFloat(totalCommitmentEmp.value);     /*  ناتج الضمانات المتاحة الموظف*/




    if (sprAvilb == 0) {
        let sprendService = 0,     /* نهاية خدمة الكافل */
            sprbalancebox = 0,     /* رصيد الصندوق الكافل */
            totalGuaranteesSpr = 0,      /* إجمالي الضمانات الكافل */
            sprdebtFurniture = 0,    /* مديونية الاثاث الكافل */
            sprdebtCar = 0,               /* مديونية السيارات الكافل */
            spranothSponosr = 0,      /* كفالة موظف اخر الكافل */
            totalCommitmentSpr = 0,       /* إجمالي الالتزامات الكافل */
            guaranteesAvailableSpr = 0;  /* الضمانات المتاحة  الكافل*/

            totalGuaranteesSpr.value = 0; /* ناتج إجمالي الضمانات للكافل */
            totalCommitmentSpr.value = 0; /* ناتج إجمالي الإلتزامات للكافل*/
            guaranteesAvailableSpr.value = 0; /*  ناتج الضمانات المتاحة للكافل*/
            totalGuaranteesAll.value = parseFloat(emptotalGuarantees.value) + 0;     /* ناتج إجمالي الالتزامات */
            totalCommitmentAll.value = parseFloat(totalCommitmentEmp.value) + 0;     /* ناتج الضمانات المتاحة */
    }else if(sprAvilb == 1){
        let sprendService = document.getElementById('sprendService').value,     /* نهاية خدمة الكافل */
            sprbalancebox = document.getElementById('sprbalancebox').value,     /* رصيد الصندوق الكافل */
            totalGuaranteesSpr = document.getElementById('totalGuaranteesSpr'),      /* إجمالي الضمانات الكافل */
            sprdebtFurniture = document.getElementById('sprdebtFurniture').value,    /* مديونية الاثاث الكافل */
            sprdebtCar = document.getElementById('sprdebtCar').value,               /* مديونية السيارات الكافل */
            spranothSponosr = document.getElementById('spranothSponosr').value,      /* كفالة موظف اخر الكافل */
            totalCommitmentSpr = document.getElementById('totalCommitmentSpr'),       /* إجمالي الالتزامات الكافل */
            guaranteesAvailableSpr = document.getElementById('guaranteesAvailableSpr');  /* الضمانات المتاحة  الكافل*/

            if (aprovalSponsor.value == 'موافقة الكافل') {
                totalGuaranteesSpr.value = parseFloat(sprendService) + parseFloat(sprbalancebox); /* ناتج إجمالي الضمانات للكافل */
                totalCommitmentSpr.value = parseFloat(sprdebtFurniture) + parseFloat(sprdebtCar) + parseFloat(spranothSponosr); /* ناتج إجمالي الإلتزامات للكافل*/
                guaranteesAvailableSpr.value = parseFloat(totalGuaranteesSpr.value) - parseFloat(totalCommitmentSpr.value); /*  ناتج الضمانات المتاحة للكافل*/
                totalGuaranteesAll.value = parseFloat(emptotalGuarantees.value) + parseFloat(totalGuaranteesSpr.value);     /* ناتج إجمالي الالتزامات */
                totalCommitmentAll.value = parseFloat(totalCommitmentEmp.value) + parseFloat(totalCommitmentSpr.value);     /* ناتج الضمانات المتاحة */
            } else {
                totalGuaranteesSpr.value = 0; /* ناتج إجمالي الضمانات للكافل */
                totalCommitmentSpr.value = 0; /* ناتج إجمالي الإلتزامات للكافل*/
                guaranteesAvailableSpr.value = 0; /*  ناتج الضمانات المتاحة للكافل*/
                totalGuaranteesAll.value = parseFloat(emptotalGuarantees.value) + 0;     /* ناتج إجمالي الالتزامات */
                totalCommitmentAll.value = parseFloat(totalCommitmentEmp.value) + 0;     /* ناتج الضمانات المتاحة */
            }
    }

    guaranteesAvailableAll.value = parseFloat(totalGuaranteesAll.value) - parseFloat(totalCommitmentAll.value);     /* ناتج إجمالي الضمانات */
    purchasingValueGurnt.value = purchasingValue.value;


    /* if (netamnt) {

    } else {

    } */

}

function netamnterr() {
    let guaranteesAvailableAll = document.getElementById('guaranteesAvailableAll'),
    purchasingValueGurnt = document.getElementById('purchasingValueGurnt'),
    netamnt;
    netamnt = parseFloat(guaranteesAvailableAll.value) - parseFloat(purchasingValueGurnt.value);
    if (netamnt < 0) {
        let netamntalert = document.getElementById('netamntalert');
        netamntalert.style.display = "block";
        /* netamntalert.innerHTML += netamnt; */
    }

}
