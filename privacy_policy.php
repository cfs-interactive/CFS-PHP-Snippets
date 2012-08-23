<?php

function privacyPolicy()
{
	header("Cache-Control: no-cache, must-revalidate");
	header("Expires: Mon, 1 Jan 2000 06:00:00 GMT");
	header('P3P:CP="IDC DSP COR ADM DEVi TAIi PSA PSD IVAi IVDi CONi HIS OUR IND CNT"');
}