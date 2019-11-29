function CheckForm(FormID) {
        var MyForm = document.getElementById(FormID);
        var text = "";
        var i;
       for (i = 0; i < MyForm.length; i++) {
            if (MyForm.elements[i].type=="text")
            {
                return MyForm.elements[i].value;
            }
            else {
                if (MyForm.elements[i].checked) {
                    text += i;
                }
            }
       }
       return text;
    }

    function CheckAllAnswers() {
        let array_of_correct_answers = ['2','0','02','1,','01','02','0','2','2','11.1'];
        var ball=0;

        for (let i=1; i<=10; ++i )
        {
            let FormID = "q"+i;

            let Forma = CheckForm(FormID);
            if (Forma== array_of_correct_answers[i-1])
            {
                ball++;
            }
        }
        document.getElementById('end2').innerHTML=""+ball;
    }
