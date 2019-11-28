var ball=0;	
function reset()
	{
		var mak=document.getElementsByClassName('v2');
		mak[0].checked=1;
		mak=document.getElementsByClassName('v1');
		mak[0].checked=1;
		mak=document.getElementsByClassName('v3');
		mak[0].checked=1;
		mak=document.getElementsByClassName('v4');
		for (var l=0; l<mak.length;l++)
		mak[l].checked=0;
		mak=document.getElementsByClassName('v5');
		for (var l=0; l<mak.length;l++)
		mak[l].checked=0;
		mak=document.getElementsByClassName('v6');
		mak[0].checked=1;
		mak=document.getElementsByClassName('v7');
		for (var l=0; l<mak.length;l++)
		mak[l].checked=0;
		mak=document.getElementsByClassName('v8');
		mak[0].checked=1;
		mak=document.getElementsByClassName('v9');
		mak[0].checked=1;
		mak=document.getElementById('q1');
		mak.value="";
		ball=0;
	}

function q111()
{
var otvet=[3,4,5,1,1,11.1];	
ball=0;	
var mass=document.getElementsByClassName('v2');

for (var i = 0;i < mass.length; i++)
	{
		if(mass[i].checked==1)
		{
			if(mass[i].value==otvet[0])	ball++;
		}
	}

mass=document.getElementsByClassName('v1');
for (var i = 0;i < mass.length; i++)
	{
		if(mass[i].checked==1)
		{
			if(mass[i].value==otvet[1])	ball++;
		}
	}

mass=document.getElementsByClassName('v3');
for (var i = 0;i < mass.length; i++)
	{
		if(mass[i].checked==1)
		{
			if(mass[i].value==otvet[2])	ball++;
		}
	}

mass=document.getElementsByClassName('v6');
for (var i = 0;i < mass.length; i++)
	{
		if(mass[i].checked==1)
		{
			if(mass[i].value==otvet[6])	ball++;
		}
	}

mass=document.getElementsByClassName('v8');
for (var i = 0;i < mass.length; i++)
	{
		if(mass[i].checked==1)
		{
			if(mass[i].value==otvet[8])	ball++;
		}
	}

mass=document.getElementsByClassName('v9');
for (var i = 0;i < mass.length; i++)
	{
		if(mass[i].checked==1)
		{
			if(mass[i].value==otvet[9])	ball++;
		}
	}
	


mass = document.getElementsByClassName('v4');
	var test  = 0;
	for (var i = 0; i < mass.length; i++)
	{
		if(mass[i].checked==1)
		{
			if(mass[i].value==1) test++; else test=4;
		}
	}	
	if (test==otvet[3])
		{
		ball++;
		}
	

mass = document.getElementsByClassName('v5');
	var test  = 0;
	for (var i = 0; i < mass.length; i++)
	{
		if(mass[i].checked==1)
		{
			if(mass[i].value==1) test++; else test=4;
		}
	}	
	if (test==otvet[4])
		{
		ball++;
		}
	

mass = document.getElementsByClassName('v7');
	var test  = 0;
	for (var i = 0; i < mass.length; i++)
	{
		if(mass[i].checked==1)
		{
			if(mass[i].value==1) test++; else test=4;
		}
	}	
	if (test==otvet[7])
		{
		ball++;
		}
	
if(document.getElementById('q1').value==otvet[5]) ball++;




if (ball==10)
{
	document.getElementById('end2').innerHTML="Молодец! Все задания верные!Количество верных ответов:"+ball;
	
}


if ((ball<10)&&(ball>5))
{
	document.getElementById('end2').innerHTML="Хорошо, но могло быть и лучше! Нужно больше читать про Россия. Количество верных ответов:"+ball;
}
if ((ball<5)&&(ball>=0))
{
	document.getElementById('end2').innerHTML="Вы плохо знаете Россию. Количество верных ответов:"+ball;
}




}
