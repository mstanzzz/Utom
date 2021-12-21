
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta http-equiv="X-UA-Compatible" content="ie=edge" />
<title>ClosetsToGo</title>
<meta name="description" content="Account idea folder details">

<script type="text/javascript" src="<?php echo SITEROOT."plupload-2.1.8/"; ?>" ></script>

<link href="<?php echo SITEROOT; ?>app.css" rel="stylesheet">
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" href="<?php echo SITEROOT; ?>plupload-2.1.8/js/jquery.plupload.queue/css/jquery.plupload.queue.css" type="text/css" media="screen" />


</head>
<body>

<?php

if(!isset($idea_folder_id)) $idea_folder_id = 0;
if(!isset($created_rooms)) $created_rooms = 0;
if(!isset($saved_items)) $saved_items = 0;
if(!isset($main_idea_folder_name)) $main_idea_folder_name = 0;
if(!isset($main_idea_folder_blob_image)) $main_idea_folder_blob_image	 = 0;
//require_once($real_root."/includes/header.php"); 
//print_r($spec_array);	
?>	

<main class="main clearfix">
<section class="account-block">
<div class="wrapper">
<div class="container-fluid">
<div class="row">
<div class="col-lg-3">
<div class="account-block__navigation--wrapper">
<div class="account-block__navigation--user js-login-txt">
<a href="#" title="" class="account-block__navigation--user-link">
<span class="account-block__navigation--user-image">
<span class="flip-front">											
<img src="<?php echo SITEROOT; ?>images/team-3.png" alt="" class="img-fluid">
</span>
<span class="flip-back">Edit/add<br>photo</span>
</span>
<span class="account-block__navigation--user-plus">
<svg xmlns="http://www.w3.org/2000/svg" width="42.5" height="42.5" viewBox="0 0 42.5 42.5"><defs><style>.add-showroom{fill:#02adb0;}</style></defs><path class="add-showroom" d="M21.25,0A21.25,21.25,0,1,0,42.5,21.25,21.274,21.274,0,0,0,21.25,0Zm9.3,23.021H23.021v7.526a1.771,1.771,0,1,1-3.541,0V23.021H11.953a1.771,1.771,0,0,1,0-3.541h7.526V11.953a1.771,1.771,0,0,1,3.541,0v7.526h7.526a1.771,1.771,0,1,1,0,3.541Zm0,0"/></svg>
</span>
</a>
<h4 class="account-block__navigation--user-heading">Hi, Joro</h4>
</div>
<div class="mobile-show">
<div class="account-block__navigation--user active js-not-login-txt">
<h4 class="account-block__navigation--user-heading">Login</h4>
</div>
</div>
<?php	
require_once($real_root."/includes/account_side_nav.php"); 	
?>	
</div>
</div>

<div class="col-12 col-lg-9">
<div class="account-block__wellcome idea-folder-details mb-2">
<p class="account-block__wellcome--heading"><span class="wellome-txt">Welcome,</span> Super Administrator! <span>How are you today?</span></p>
<p class="account-block__wellcome--text">
<?php 
$ts = time();
echo date("d D Y, l", $ts);
?>
</p>
</div>

<div class="account-block__general-info idea-folder-details mb-2">
<div class="row m-0 w-100">
<div class="col-12 col-lg-8 p-0">
<div class="d-flex flex-column justify-content-center w-100 h-100">
<div class="d-flex">
<div class="account-block__general-info--image idea-folder-details-img">
<p>Idea folder</p>
<svg id="Component_18_1" data-name="Component 18 – 1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="88.333" height="70.265" viewBox="0 0 88.333 70.265">
<defs>
<linearGradient id="linear-gradient" x1="-3.495" y1="-5.332" x2="-3.556" y2="-9.089" gradientUnits="objectBoundingBox">
<stop offset="0" stop-color="#009ede"></stop>
<stop offset="1" stop-color="#00aeec"></stop>
</linearGradient>
</defs>
<g id="Group_447" data-name="Group 447" transform="translate(0 0)">
<g id="Group_446" data-name="Group 446" transform="translate(0 0)">
<image id="Rectangle_54" data-name="Rectangle 54" width="88.333" height="70.265" opacity="0.25" xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAWAAAAEYCAYAAABiECzgAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAABa2SURBVHhe7d2HkhvZlUVR9ci7kR3z/983M/Je6h4cELt46lYmgDLkA1h7RdzIhEcEs3Y/PpZCX33zzTffkiR9fjcV4K8OTqd6hsOfof8Vle7QZw/whcga4JfZ/EM0zNJt++QB3ghu3z73mK43/xD79sO5QZZuyycLcIX3ucfoc+3bCm0ft+47MsbSem8a4LHazXnH9dzEPNdlHdZ5vjfR58ZYWuRNAryz2mX+bZxzu++fExy1bca05+vTcN7HOXE8GmLp83p1gE/x7WhmCO3efHvc5jXzvbSv49mRnfOvjfsy/bp+L0MsfSYvDvBY9TId1UR2b75zmH4O8eWYCY56rIOZ6bAS3H+ezvemX5PhvSIN5lzSJ/KiAI9Vb8dzRpb57jjncY55LcN78/4c9cFDJGsSUKKaY+K7Nf84HXnOVoz7fV0NS5/QswNc8WVmeInt907ne0eCTIDzWgKcY+S8j+8df1gEktmKb2Lb8/dxnEHuGOc9c4w0OLclvbFnBXjEN5Hs+CaqBDbz/Z0hwEwCzHvwnnxGcNQH/IERyRw7oB3fxDbzt51jhudm+n0erYaNsPT2rg7wmfh2eInsDw7zw3FkZoRZBV8T4D5/T/oPifMcZ4B79UtgE9vMX2u4zWOZjnFH+CHERlh6W1cFeCe+iSYR7ehmfjSG+4kwq+QOMO/bAc4Ex/eOP6xjEE9DJAkwEe0AJ7Z/qeOcDjMh7q2Jhwgfxn1h6Y1cDPCF+LLqJbo/rvlJnRPiGWDiS4CzCu7Py6DP36P+gyKGmRngrRUw4f1zHf80jsS4V8S8H5+RifMXjXTjbmUR8ZwAE8gMAWXVS3AzP63hvg4wWxAd4Ln9kGMY4I/6D4rzBDHnBHhrFdwB7vj+sY6c57EMK+KOcN6bz4rzF4502zav388d5rMBHvHNJJasfBPTRJXI/vtpfnY6doTzPLYgEmC2LojvDDCxndGdt9+L+YfE7RyJMFsFBJMIs6LdCnDmDzWEOMNqOBHO++Q98/58XszvJd2LvnY3zz9HjHcDXPHNEN8M+73EN5FNdDM/r3MizBZEAszqdyu+fA6R5Rh9/p7NC6WHOM6VMKvgjjABJry/r+kQzwgT+f5c6Z70Nct5H5ng+MlifE2AE8VEcmvly4o34f3FaYhwHstzEmDiy+qX+PLefFZPm7ffq/mHlds95yKc6b3gBJYA/65mL8KsgjvCwVG6B33dcj4XFXPieHzrEG8GeKx+E8gEM+Hcim+i+8vTEOE8lmH1m9ftrXznqpfztnXfe7T1h5/7eogwIU40Mx1h9npZBXeAGSLMqtlVsO4d12pfu1zLfWT6/kykwZy/2qUAJ47EN6tX/sEtcWXV+6vDJL4cc3+vfnvft+PL+/NZwXHPpce/VJf+wLlAeriIWA0nnpmsZlkJsxWRVS/h/e3pmPv2VsF9gQZH6Vb1tcpwHTP8rHA+H+/Xvslq+EmAd1a/bD0kqNnX7fj++nTM5L48xt5v7/vuxTc4Yt7WtnkBcHH0cDFleiXMypatiI4wAc79BDjRJuLzgpRuGdco12uGa5ifjf4ZYfp+nt/XfRqc44udC/Bc/bL1wLYD8WUIMKvf3nqY8e0Jjnod/jAfLpDT9MU2Izz3gwlxr4DzHP4xjguzL0TplnGN8rPAkbgSXBYYPTzW1z3zcP2/NMR7AU58M4lvr34T10Q2Ww3/cRoC3NsPiW9Wv+z7nosv5m09z7wAuJ1jhoumI8x2BBFmT5jJ7TzGFoQB1r2ZPwcZfg74WSC2LEz42eB8xpjXvjrCjwI8Vr8JZu/98utmHd+OcMKcx7P6zfMTbfZ9CfoMr9H9NPpC4AJhZoQz/Q9zhDhHVr95vPeA++ILjtIt6us0123/DPTPQa5xFiUcOef6z/N4He/18LPw3AifC/Dc+2X1m62GRPc/T5Pz3Mfql394662HGV/D+3n0xZBzhv+C5yLiouJiY8VLkLkA8xwC/Oiik27QvPY5cu3O67+Dm+uf4eeBn4P5s8Bi5Pjz8BYBZrXK9kPv/fbq978OkwD39gN7v/1bDx1fw7tGX4DM3kXYFyIX3dYF1+8l3SquT65VYrkXYKLL3/76b4JEOc/LazKvivBegBNOth8S1KxsE1hWv8S3A8zqt/d+ibnxvQ1chAwXYiYXIhfjnFxkzMOFdhrpVvX12dc81z3XdK5xFhwJLNHNVtychDjTi5O8Bz9Hx8+5NsIPAT7FdwY4Me3th8Q20U2AiTC//cCvnvFrZ2w9ZMIA3wYujL4Y5wXJapcjFxjPPV5kp5FuVV+ffc1yvWd60ZGoEliCy28G8WuZmV4R998Q+Rk5fs41Ed4KcMLJ/m8CPLcfiG+m9397+2Fv71e3gQuDi5EjF+XW5PGHi+s00q3q65Nzrluu5VzXLDQIcG9BdHz7d+T5DaE8hy2JXqwcf05eEmBWrL3/y//wIqHt1W8mK+Lc37/9kNex9+vq93ZtXZQc94bnZqRb19cp51y/uZ5ZXCSemd4HngHO/0K0hxUxEe7tiIefl0sR3gpw//oZ+7/89kMC/N+H6QDP/d+8lgC7+r1t86KcM6PLSPdgXqvzOt6LMKtgtiCy6k10/+8wvznNXoRZCT/87JyL8LkAz18/y3bDVoDzWJ6TWPO7v24/3I++OI4XzIfTh/O+3UfpHszrlWuaIcJsH2QVS4R7FUyAe3IfWxLsCT/ZD35ugPkHOALM/m9im+jOAPP7v+z/zgDrPvRFwvnWfdI9OHe95rGerQjzD3KJMAHOyjfh/d/T5Dz3JcL8hkTvBx8jfDHAp/gS4MQz+7gJcP8DXAc4k9UwAc4+cQc472OA79PWxbJ7AUl3pK9jznNMgJmEMwElwr0KTmyJ7/+cjkQ4jyfCbEUQ87Or4ERyD1HuOM/h/n6e7lv/WfLnOe9znHuc2S8mi878zZ+//WcBmsVkFqFZWGYhmslCM3/bz+Q892WXgO3XvO5ZW7B50jRfxO0MX7hv9+Poc923/vN1nC9taFqGEM8I87+HIMTEOMfEN4/neXk+Iec9j59z2mV4Ik/YwxcMzuegzyXp1nXDON8KcUe4V8MJMpPH8rw3WQFP/SXBGzOSdI9my7YizGo4oSXEbD30CpgA53VXRfiaAAdvcPbNJOlOdePORbhXw8SXAOfxvQBvbkNcG+DoF883eviQ4y1Juj+zcYR4K8KEuOObxzMEuCO86TkBngyupC8NXWPSyL2VcE/uYwWcmfHl+MhLAjzf6NJtSbo36VgmjdyKMCHuyX15fGsLYtNLAixJXzKC2RFOULdWwnsBzhDvhxDPfWADLEn7ZoSJa6+EmdzXK+CLq2ADLElPdTQ57wgTWqLbQ4DPxjcMsCTtI6AMEc7shZf4Mv36RwywJF1GfBlCm+jO6Qg/iW4zwJK0r1evHWEiS4T7yHPma58wwJK0bUaTkBLYTIe47+O5TBzP+zch8mRJ0nkdU4bgzpnP25UnS5L2zYjm9gztufj2+SMGWJKutxXWvQmOmwywJL3MjG3snW8ywJL0fDOuHeI+P8sAS9J19qLa918VXhhgSbper277/EUMsCRdNkN76fZVDLAkLWKAJWkRAyxJixhgSVrEAEvSIgZYkhYxwJK0iAGWpEUMsCQtYoAlaREDLEmLGGBJWsQAS9IiBliSFjHAkrSIAZakRQywJC1igCVpEQMsSYsYYElaxABL0iIGWJIWMcCStIgBlqRFDLAkLWKAJWkRAyxJixhgSVrEAEvSIgZYkhYxwJK0iAGWpEUMsCQtYoAlaREDLEmLGGBJWsQAS9IiBliSFjHAkrSIAZakRQywJC1igCVpEQMsSYsYYElaxABL0iIGWJIWMcCStIgBlqRFDLAkLWKAJWkRAyxJixhgSVrEAEvSIgZYkhYxwJK0iAGWpEUMsCQtYoAlaREDLEmLGGBJWsQAS9IiBliSFjHAkrSIAZakRQywJC1igCVpEQMsSYsYYElaxABL0iIGWJIWMcCStIgBlqRFDLAkLWKAJWkRAyxJixhgSVrEAEvSIgZYkhYxwJK0iAGWpEUMsCQtYoAlaREDLEmLGGBJWsQAS9IiBliSFjHAkrSIAZakRQywJC1igCVpEQMsSYsYYElaxABL0iIGWJIWMcCStIgBlqRFDLAkLWKAJWkRAyxJixhgSVrEAEvSIgZYkhYxwJK0iAGWpEUMsCQtYoAl6bJvTsc3ZYAl6fneJMgGWJKuk+gy04uCbIAlaRtR3YvrXoyvZoAl6alL8W0vjrABlqTHZlBze2tezQBL0keEdYZ23o4+fxEDLEkfdGw5Zr6u857g+CIGWJKeBpXIXppXMcCS3jtC2sdMVr5zuJ/n9ATHqxhgSXoc0EzHdk4/zgTHqxlgSe9ZR5OYdmT3hudmguOzGGBJ+qCjOoP7r437XhXfMMCS3juiG5xnZnB7+nkvZoAl6YOOKpGd4eX+OS9igCXpMaJKbGeAuZ+JPr+aAZakpyFlZmznvIoBlqQPZlBnbM/NixhgSfpoK6p9H/f34y9mgCVp2wwv0eX4agZYkp7ai+ybxTcMsCQtYoAlaREDLEmLGGBJWsQAS9IiBliSFjHAkrSIAZakRQywJC1igCVpEQMsSYsYYElaxABL0iIGWJIWMcCStIgBlqRFDLAkLWKAJWkRAyxJixhgSVrEAEvSIgZYkhYxwJK0iAGWpEUMsCQtYoAlaREDLEmLGGBJWsQAS9IiBliSFjHAkrSIAZakRQywJC1igCXpqa9Ox2t9U0fOLzLAkrQtEd4adHT7GFdF2ABL0kdbod26ja0IXxXfMMCS9EGHNQjvnGlGGBdjbIAl6WNYZ2zTyHkfEx3fOZi3HxhgSXqMwO7Fd+rofj1uZ3YZYEn6oCNLfHPs4fHoyCa8e/Ht4zfx4eaHN5Sk96yjynnmXHyRmHZ8Oe8Y7zLAkvTBpfhyzMQM7r/qnPj2PJE3lKT3ipgGcZ3TEc5Eh7UjPGczvDDAkvQxrDHD2zMj3LHNCvhZq+C8oSS9ZwSVuPZ0dBliuhferfhuMsCS9CGsHPcmiGnHl+OMcGY3vmGAJekDIjujyxGsaoks8e0hvj1PGGBJ+mjGdiu+hPdcfJnd+IYBlqSnegUMYnouvpmt+B7P+3+EEQZYkh6b4cVWfP9ZQ3w5EuBH0W0GWJLO65B2gInuVoT7NbteEuD5hpduS9I9IqAZwpvp4P6jzjvKPLff44nXrIB331SSviC0LmFliG5mRviq+MZzAtxvMt/w4gdJ0p3olnFOVDu6mb/XOQGeEd51bYDnl5GkLx29S0gJa4YAz/gyBJjXH2f+BkRcE2Be1C9+eNPTSNKXgJ7RNlaymRneHHtyX69+M2edC3DHdX6pfiz6XJLuGT3LseNLgPfie24FvGkrwPMF3J5v2PcFx+hzSboHs2HEd247/G0MASbCM8C7rlkB9/CF+s3nSNK9omN0jvhmWO0mun89HWeE8/wnK+Ct/d84Bvj0IBN9my8yhw9h+jWSdE+6W3SMzm3Ft4fHCHV38axzWxB8gf4iXfcenj9t3SdJt4iO0bVz8f3LaVgBswVBH2nf2QZeswXBl+kvxHSQeX6PJN06WtXtonWJauJLdP98GgKc+9mC2GriWdesgPkie8MHXv2hknRj9prXK98OcEd4BvjRgnRv/zdmgHkiL+bL8IVYZmf4gv2hDK8PjpJ0a2gV070jvoT3T+PYK2CaSAt5v7POrYA7qISW+OaLZTrEfHFee9UXkKRFaBTNomE0rvd6Ce8fT0cinOd0CzvAF+3tAfOl8ma86YxvhqV3f3iG1+OqLyNJnwF9Ylho0jvalrh2eHtYAc8G9uLz7PZDPAT49MSe/lId33wgX45zvgABfvQlDiNJq3WPOKdziWc3rle9f6jpFTBbEHkNC9Bu30XnVsB8sflfBeLLnIswXyau+kKS9MY6iLNt9I34pmnEN7ElvL+v8xnfvJbVL827uPqNc3vAfNH+gsQ3H95DiPvLEGHeKzhK0qc228MQStrG4pK2seVAeHt6C4Lu9cKzP/OiS3vAfEn+6zD/C8FsRZgAM3ypq7+cJL0A/QrOM/SMptE14tur3sT2dzW5zQqY5hFfFpwPn3XN6jceBfj0Il5IOPPG/V+Jji97IZn+UkS4V8Izwld9QUm6Ak3poTlENz3KEN/u2Vzx/nYMEaZ1CfbWYjOfd7VrV8B8af5LkS/d8WU6wpmtCPeX5HMk6bnox+xJhtZ0fNOjXkjSsbnq/U1NxzfPy/NpHPGlb8fPvnb1G19tPferg8Mhcf72Yb5zmO8d5oeH+fFh/v0wPz/MLw/z6zG572eH+elh8ty85vuH+e5h8j55T4b/6+e9/wtoSbqEgB3jN4YIE+JeASfEWUyy9UCIiTArXyKc+4nw3gr4+LlvFWAinHAmoAnpjw7zk8Mkwr84TEf4V6fbuT+PJ8J5/g8Ok4DnPRL0DAFm0OeSNM1gHaM3pqPLEN4Mf0M/twomwqx+8xh/y09883qCzuc9K75xKcCZXgUnpolq4pqVLhFOfFkB5748lgizCibCeZ/MuQhP5x6T9OU6FzNiG6w+CWFmrnhZ9c6Vb4b49h5wT289EF9WvpkXxTc2Axwbq+BMVsFsRcwIM7mdLQpWwXluApzJKvialXDM25Lepxmp3J5DCIniVngTzgSUlW9vPRDgOax6iS/bDnn/fE4+++uXxDeuCXCGYGYVOyOc2GYSXia32QvOlkVWzXlNXt8r4QTYCEvaMwOV2z294p3hzSS6verNsPJl9ZvIJrY5ZwhvJq/hfYgvn3v8Hm8e4Bir4AQ40STCiSoR5h/metiGSIDzvN4PJsKsgolwdHQNsPS+daA4P0bvMIQ3x0SR+PaKl1Vvx7dXv1vT4c3wfnzGm8Q3rglwEMmOcGLaK+HENpPwMr0NwSr40n5wGGFJHSfOj9E7DBFk5TtXvR1ftg8IL0eG6OZ+htf3qpfYv0l842yAo1bBmYQy0WQvlwgnrlnpJrYd40zuZxVMgPtX0xLgTH8O+lzS+9OBOkbvNIRwb+XL6pXw7k3C25HeCi+r3gT44Tu8Nr5xMcBREWYlzOqV7YhElS0JgpsQc8z9M8B5Lf8gx/saYEmtA0X8iC8BZuVLfAkwUZ3HPue5RHeG98mqN/MW8Y2rAhwXItxbEglxx5j49hYEAeY9tgJsfCUFkSKABDFxJJTEswO8NVvBZfbC2/E91jfHt/DcAB9PDzMjnJVsr4ZZEXeQc57JczJsY7AFQYCj42uIpfep48R5jjPAWyvgDm3PDG5H91x4093+Pm/i6gDHToQTT0LMapjIEuNe+WbynLkHvBdgSSJUOc4AE+GOa8eWc4K7Fd3d8B7mTVe97VkBjp0Id4hZ2c4Yc97xJcDElwmOkt43IkUQMwR4RpgQ95GZwWU6uhzjePxU8Y1nBzhGhDMdYULcMSbInG/Fl2NwlKToKGaIJhElroS4z3l8BreH943j8VOGFy8KME4h7pkh7hj38BjP7/cIjpIUHUeGeBLVjmyfMx1bjkwcj58jvHhVgKMiHDkSVEI8g9zh5bnzPSRp6lAyRJUhtB1chufP9zn6nOHFqwMcpwgfTzemY0tw+5wJjpK0ZcYzM+O6FdyeOB5XRLe9SYBxIcTnJjhK0jkdUc63QstEny8PL940wBghnkcmOEafS9Kejhbnfdw6v5notk8SYFSI45pzSbpWx2vz/Baj2z5pgNuIcTPAkl5iM163Ht322QK850yYJWnXPYV2z/IAS9J7lV8FkyR9dt/61v8DlTZGKCRSIwsAAAAASUVORK5CYII=" style="mix-blend-mode: multiply;isolation: isolate"></image>
<g id="Group_445" data-name="Group 445" transform="translate(2.133 2.133)">
<g id="Group_444" data-name="Group 444">
<path id="Path_349" data-name="Path 349" d="M149.031,136.228H189.4a7.854,7.854,0,0,1,2.2.321l7.6,0A5.715,5.715,0,0,0,193.51,131H148.315a5.044,5.044,0,0,1,.716,2.589Z" transform="translate(-117.663 -127.863)" fill="#e3bc00"></path>
<path id="Path_350" data-name="Path 350" d="M195.208,182.137h-1.046v1.044a6.448,6.448,0,0,1-3.713,5.523c4.682-1.148,6.709-4.475,6.833-9.7h-2.074Z" transform="translate(-115.741 -125.674)" fill="#e3bc00"></path>
<path id="Path_351" data-name="Path 351" d="M197.6,136h-.3l-7.6.137a5.678,5.678,0,0,1,3.072,1.954h2.95l-.015,42.87h1.871Z" transform="translate(-115.775 -127.635)" fill="#fff"></path>
<path id="Path_352" data-name="Path 352" d="M194.062,184.007h1.046V180.9L195.6,138h-2.95a5.3,5.3,0,0,1,1.412,3.491Z" transform="translate(-115.641 -127.544)" fill="#b8b8bd"></path>
<path id="Path_353" data-name="Path 353" d="M197.421,185.507V141.947a4.937,4.937,0,0,0-1.412-3.446,6.87,6.87,0,0,0-3.072-1.815,7.854,7.854,0,0,0-2.2-.321H150.368v-2.639a5.044,5.044,0,0,0-.716-2.589,6.892,6.892,0,0,0-5.9-3.137H124.859A5.577,5.577,0,0,0,119,133.726v51.781a6.04,6.04,0,0,0,5.859,6.276h65.877a6.6,6.6,0,0,0,2.973-.74A6.467,6.467,0,0,0,197.421,185.507Zm-68.451-54.37h15.125v5.228H125.274v-5.228Z" transform="translate(-119 -128)" fill="#ffd226"></path>
<path id="Path_354" data-name="Path 354" d="M125,136.228h18.821V131H125Z" transform="translate(-118.726 -127.863)" fill="#fff"></path>
</g>
</g>
</g>
</g>
<g id="Group_448" data-name="Group 448" transform="translate(31 25.249)">
<path id="Path_355" data-name="Path 355" d="M461.985,272.5l-3.668-.011c-.767-8.147-7.629-13.754-15.985-13.754a16.035,16.035,0,0,0-5.689,1.039c5.062,2.477,8.627,6.762,8.978,12.68l-3.65-.009c-1.222-.005-1.5.687-.62,1.533l8.961,8.626a2.357,2.357,0,0,0,3.214.014l9.066-8.586C463.481,273.192,463.207,272.5,461.985,272.5Z" transform="translate(-436.644 -258.733)" fill="url(#linear-gradient)"></path>
<path id="Path_356" data-name="Path 356" d="M478.242,322.6l-9.066,8.585a1.792,1.792,0,0,1-2.447-.009l-8.963-8.627c-.025-.024-.046-.046-.067-.069a.665.665,0,0,0-.271.086,1.1,1.1,0,0,0,.338.473l8.963,8.625a1.79,1.79,0,0,0,2.447.011l9.066-8.585a1.084,1.084,0,0,0,.342-.469.708.708,0,0,0-.276-.085C478.287,322.553,478.265,322.573,478.242,322.6Z" transform="translate(-452.675 -307.897)" fill="#7bd2f6"></path>
</g>
</svg>
</div>
<div class="account-block__general-info--details d-flex flex-column justify-content-center align-items-start w-100">
<div class="row w-100">
<div class="col-12"></div>
</div>
<div class="row w-100">
<div class="col-7">
<p class="second-text">
Created room/s:
</p>
</div>
<div class="col-5">
<p class="second-text">
<?php echo $created_rooms; ?>
</p>
</div>
</div>
<div class="row w-100">
<div class="col-7"><p class="second-text">Saved item/s:</p></div>
<div class="col-5"><p class="second-text">
<?php echo $saved_items; ?>
</p>
</div>
</div>
</div>
</div>
<div class="account-block__buttons-block idea-folder mt-4 mb-0">
<a href="account-idea-folder.html" class="account-block__buttons-block--button js-back-house-list">
<span class="button-image">
<svg xmlns="http://www.w3.org/2000/svg" width="24.5" height="20.417" viewBox="0 0 24.5 20.417"><defs><style>.arrow-new{fill:#384765;}</style></defs><path class="arrow-new" d="M31.479,21.187H11.114l7.8-7.428A1.021,1.021,0,0,0,17.5,12.281L8.6,20.764a2.041,2.041,0,0,0,.018,2.9L17.5,32.135a1.021,1.021,0,1,0,1.408-1.478l-7.831-7.428h20.4a1.021,1.021,0,0,0,0-2.042Z" transform="translate(-8 -12)"/></svg>
</span>
<span class="button-text">
Back to gallery<br />
<span>your house/s overview</span>
</span>
</a>
</div>
</div>
</div>


<div class="col-12 col-lg-4 p-0">
<div class="idea-folder-details-specification">						
<img src="<?php echo SITEROOT; ?>images/my-house-1.png" alt="" class="img-fluid">
<div class="idea-folder-details-specification--wrap">
<div class="idea-folder-details-specification--content">
<div class="house-checkbox">
<input class="custom-checkbox js-load-confirm-modal" id="checkbox-1" type="checkbox" value="value1"  data-target="#confirmModal">
<label for="checkbox-1">Share with Closets To Go</label>
</div>
<span>Share the whole ideas folder with us</span>
</div>
</div>
</div>
</div>
</div>
</div>


<!-- My houses block -->
<div class="account-block__details idea-folder-details active" id="my-houses">
<div class="row">
<div class="col-12 col-lg-3 js-folder-nav-wrap">
<div class="nav flex-column nav-pills folder-nav" id="v-pills-tab" role="tablist" aria-orientation="vertical">
<?php
echo $rooms_block;
?>
<a class="nav-link folder-nav__link js-hide-folder-nav js-desktop-active" 
id="v-pills-global-tab" data-toggle="pill" href="#v-pills-global" role="tab" aria-controls="v-pills-global" aria-selected="false">Global <span>5 <span>items</span></span></a>
<a class="nav-link folder-nav__link js-hide-folder-nav" 
id="v-pills-living-room-tab" data-toggle="pill" 
href="#v-pills-living-room" role="tab" aria-controls="v-pills-living-room" aria-selected="false">Living Room <span>5 <span>items</span></span></a>
<a class="nav-link folder-nav__link js-hide-folder-nav" id="v-pills-bedroom-tab" data-toggle="pill" href="#v-pills-bedroom" role="tab" aria-controls="v-pills-bedroom" aria-selected="false">Bedroom <span>0 <span>items</span></span></a>
<a class="nav-link folder-nav__link js-hide-folder-nav" id="v-pills-kitchen-tab" data-toggle="pill" href="#v-pills-kitchen" role="tab" aria-controls="v-pills-kitchen" aria-selected="false">Kitchen <span>0 <span>items</span></span></a>
<a class="nav-link folder-nav__link js-hide-folder-nav" id="v-pills-dining-room-tab" data-toggle="pill" href="#v-pills-dining-room" role="tab" aria-controls="v-pills-dining-room" aria-selected="false">Dining room <span>0 <span>items</span></span></a>
<a class="nav-link folder-nav__link js-hide-folder-nav" id="v-pills-family-room-tab" data-toggle="pill" href="#v-pills-family-room" role="tab" aria-controls="v-pills-family-room" aria-selected="false">Family Room <span>0 <span>items</span></span></a>
<a class="nav-link folder-nav__link js-hide-folder-nav" id="v-pills-guest-room-tab" data-toggle="pill" href="#v-pills-guest-room" role="tab" aria-controls="v-pills-guest-room" aria-selected="false">Guest Room <span>0 <span>items</span></span></a>
<a class="nav-link folder-nav__link js-hide-folder-nav" id="v-pills-bathroom-tab" data-toggle="pill" href="#v-pills-bathroom" role="tab" aria-controls="v-pills-bathroom" aria-selected="false">Bathroom <span>5 <span>items</span></span></a>
<a class="nav-link folder-nav__link js-hide-folder-nav" id="v-pills-game-room-tab" data-toggle="pill" href="#v-pills-game-room" role="tab" aria-controls="v-pills-game-room" aria-selected="false">Game Room <span>0 <span>items</span></span></a>
<a class="nav-link folder-nav__link js-hide-folder-nav" id="v-pills-basement-tab" data-toggle="pill" href="#v-pills-basement" role="tab" aria-controls="v-pills-basement" aria-selected="false">Basement <span>5 <span>items</span></span></a>
<a class="nav-link folder-nav__link js-hide-folder-nav" id="v-pills-home-office-tab" data-toggle="pill" href="#v-pills-home-office" role="tab" aria-controls="v-pills-home-office" aria-selected="false">Home Office <span>0 <span>items</span></span></a>
<a class="nav-link folder-nav__link js-hide-folder-nav" id="v-pills-nursery-tab" data-toggle="pill" href="#v-pills-nursery" role="tab" aria-controls="v-pills-nursery" aria-selected="false">Nursery <span>0 <span>items</span></span></a>
<a class="nav-link folder-nav__link js-hide-folder-nav" id="v-pills-playroom-tab" data-toggle="pill" href="#v-pills-playroom" role="tab" aria-controls="v-pills-playroom" aria-selected="false">Playroom <span>0 <span>items</span></span></a>
<a class="nav-link folder-nav__link js-hide-folder-nav" id="v-pills-library-tab" data-toggle="pill" href="#v-pills-library" role="tab" aria-controls="v-pills-library" aria-selected="false">Library <span>0 <span>items</span></span></a>
<a class="nav-link folder-nav__link js-hide-folder-nav" id="v-pills-storage-room-tab" data-toggle="pill" href="#v-pills-storage-room" role="tab" aria-controls="v-pills-storage-room" aria-selected="false">Storage room <span>0 <span>items</span></span></a>
<a class="nav-link folder-nav__link js-hide-folder-nav" id="v-pills-gym-room-tab" data-toggle="pill" href="#v-pills-gym-room" role="tab" aria-controls="v-pills-gym-room" aria-selected="false">Gym room <span>0 <span>items</span></span></a>
<a class="nav-link folder-nav__link js-hide-folder-nav" id="v-pills-garage-tab" data-toggle="pill" href="#v-pills-garage" role="tab" aria-controls="v-pills-garage" aria-selected="false">Garage <span>0 <span>items</span></span></a>
</div>
</div>



<div class="col-12 col-lg-9 js-folder-nav-content">
<div class="tab-content" id="v-pills-tabContent">






<div class="tab-pane fade" id="v-pills-all" role="tabpanel" aria-labelledby="v-pills-nursery-tab">
<div class="folder-wrapper">
<div class="desktop-show">
<div class="row mb-2">
<div class="col-8">
<h3 class="folder-wrapper__heading">Title - All LLLLL</h3>
</div>
</div>
</div>
<div class="row">
<div class="col-12 js-saved-images-box">
<div class="new-idea-folder-images__wrapper">
<div class="new-idea-folder-images__buttons">
<p class="new-idea-folder-images__empty-text">
No saved files in .......!
</p>
</div>
<div class="mb-2">
<p class="idea-folder-empty-house__text">You can add them from our website or by adding external images by choosing the option below</p>
</div>
<div class="folder-wrapper__saved-elements">
<figure class="folder-wrapper__saved-element specification-sheet">
<figcaption class="folder-wrapper__saved-element--folders">
<span class="folder-wrapper__saved-element--folders-img">
<svg xmlns="http://www.w3.org/2000/svg" width="24.704" height="16.27" viewBox="0 0 24.704 16.27">
<g id="open-folder-black-and-white-variant" transform="translate(0 -87.578)">
<path id="Path_434" data-name="Path 434" d="M18.618,102.844a1.7,1.7,0,0,0,1.429-.84l4.57-8.648c.273-.526-.124-.84-.84-.84H19.163V90.451a1.3,1.3,0,0,0-1.293-1.293H6.573l-.838-2.2a.59.59,0,0,0-.551-.38H.6a.589.589,0,0,0-.59.593l.011,3.28L0,101.554a1.3,1.3,0,0,0,1.293,1.293m16.69-10.33H7.922a1.392,1.392,0,0,0-1.134.84l-4.109,8.311H1.293a.114.114,0,0,1-.114-.114v-13.8h3.6l.838,2.2a.59.59,0,0,0,.551.38h11.7a.114.114,0,0,1,.114.114v2.066Z" transform="translate(0 1)" fill="#fff"/>
</g>
</svg>
</span>
<div class="folder-wrapper__saved-element--buttons">
<button class="shere">
<svg xmlns="http://www.w3.org/2000/svg" width="23.547" height="25.688" viewBox="0 0 23.547 25.688"><defs><style>.share-white{fill:#fff;}</style></defs><g transform="translate(0)"><path class="share-white" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"/><path class="share-white" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"/><path class="share-white" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"/><path class="share-white" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"/><path class="share-white" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"/><path class="share-white" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"/><path class="share-white" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"/><path class="share-white" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"/></g></svg>
</button>
<button class="delete" data-toggle="modal" data-target="#deleteFolder">
<svg xmlns="http://www.w3.org/2000/svg" width="14.932" height="16.033" viewBox="0 0 14.932 16.033"><defs><style>.trash-white{fill:#fff;}</style></defs><g transform="translate(0 0)"><g transform="translate(0 0)"><g transform="translate(0 0)"><path class="trash-white" d="M63.331,124.769a1.305,1.305,0,0,0,1.351,1.168h5.771a1.328,1.328,0,0,0,1.374-1.191l.939-9.8H62.186Z" transform="translate(-60.01 -109.905)"/><path class="trash-white" d="M27.028,2.061h-4.26V1.328A1.283,1.283,0,0,0,21.533,0H18.577a1.282,1.282,0,0,0-1.306,1.259q0,.035,0,.07v.733h-4.26a.458.458,0,0,0,0,.916H27.028a.458.458,0,1,0,0-.916Zm-5.176-.733v.733H18.188V1.328a.366.366,0,0,1,.389-.412h2.886a.366.366,0,0,1,.391.34A.362.362,0,0,1,21.852,1.328Z" transform="translate(-12.554 0)"/></g></g></g></svg>
</button>
</div>

<p class="folder-wrapper__saved-element--text first">Specification sheet</p>
<button class="folder-wrapper__saved-element--folders-button"><span onClick="open_specs();">open folder</span> zzzzzz</button>
</figcaption>

</figure>
<figure class="folder-wrapper__saved-element folders">
<figcaption class="folder-wrapper__saved-element--folders">
<span class="folder-wrapper__saved-element--folders-img">
?	<svg xmlns="http://www.w3.org/2000/svg" width="86" height="71.044" viewBox="0 0 86 71.044"><defs><style>.folder-orange{fill:#edb700;}</style></defs><g transform="translate(-10.667)"><g transform="translate(10.667 7.478)"><g transform="translate(0)"><path class="folder-orange" d="M87.319,53.884H44.1a5.6,5.6,0,0,1-5.321-3.836l-.329-.991a9.337,9.337,0,0,0-8.865-6.39H20.015a9.361,9.361,0,0,0-9.348,9.348v44.87a9.358,9.358,0,0,0,9.348,9.348H34.971a1.87,1.87,0,1,0,0-3.739H20.015a5.615,5.615,0,0,1-5.609-5.609V52.015a5.615,5.615,0,0,1,5.609-5.609h9.568A5.6,5.6,0,0,1,34.9,50.239l.333.995a9.337,9.337,0,0,0,8.865,6.39H87.319a5.615,5.615,0,0,1,5.609,5.609V96.884a5.615,5.615,0,0,1-5.609,5.609H72.363a1.87,1.87,0,0,0,0,3.739H87.319a9.356,9.356,0,0,0,9.348-9.348V63.232A9.358,9.358,0,0,0,87.319,53.884Z" transform="translate(-10.667 -42.667)"/></g></g><g transform="translate(14.406)"><path class="folder-orange" d="M101.174,0H41.348A9.361,9.361,0,0,0,32,9.348a1.87,1.87,0,0,0,3.739,0,5.615,5.615,0,0,1,5.609-5.609h59.826a5.615,5.615,0,0,1,5.609,5.609V20.565a1.87,1.87,0,1,0,3.739,0V9.348A9.359,9.359,0,0,0,101.174,0Z" transform="translate(-32)"/></g></g></svg>
</span>
<p class="folder-wrapper__saved-element--folders-text">Nice things for living room</p>
<button class="folder-wrapper__saved-element--folders-button js-show-add-to-rooms-new-idea-folder-images-btn">View folder</button>
</figcaption>
</figure>
<figure class="folder-wrapper__saved-element add-new-button js-url-modal-btn" data-tab-parrent="#v-pills-nursery" data-button-positon="room-name" data-toggle="modal" data-target="#newImageUrl">
<figcaption class="add-new-button__wrap">
<span class="svg-group">
<span class="svg-group__first">
<svg xmlns="http://www.w3.org/2000/svg" width="34.215" height="51.323" viewBox="0 0 34.215 51.323">
<path id="Path_451" data-name="Path 451" d="M161.684,17.839,146.714.731a2.134,2.134,0,0,0-3.216,0L128.529,17.839a2.137,2.137,0,0,0,1.608,3.546h8.554v27.8a2.139,2.139,0,0,0,2.138,2.138h8.554a2.139,2.139,0,0,0,2.138-2.138v-27.8h8.554a2.137,2.137,0,0,0,1.608-3.546Z" transform="translate(-127.998)" fill="#fff"/>
</svg>
</span>
<span class="svg-group__second">
<svg xmlns="http://www.w3.org/2000/svg" width="21.992" height="9.797" viewBox="0 0 21.992 9.797">
<path id="Path_448" data-name="Path 448" d="M20.286,207.506a1.764,1.764,0,0,0-1.764,1.764v4.5H3.586v-4.5a1.764,1.764,0,0,0-3.528,0v6.269A1.764,1.764,0,0,0,1.822,217.3H20.286a1.764,1.764,0,0,0,1.764-1.764V209.27A1.764,1.764,0,0,0,20.286,207.506Z" transform="translate(-0.058 -207.506)" fill="#fff"/>
</svg>
</span>
</span>
<p class="folder-wrapper__saved-element--folders-text">Add an external URL of image or upload an image from the device</p>
</figcaption>
</figure>
</div>
</div>
</div>



<div class="tab-pane fade" id="v-pills-global" role="tabpanel" style="display:none" aria-labelledby="v-pills-global-tab">
<div class="folder-wrapper">
<div class="desktop-show">
<div class="row mb-2">
<div class="col-8">
<h3 class="folder-wrapper__heading">Title house name - Global</h3>
</div>
<div class="col-4">
<p class="folder-wrapper__all-items">
<span class="folder-wrapper__all-items--img">5</span> images / 
<span class="folder-wrapper__all-items--subfolders">1</span> subfolder
</p>
</div>
</div>

<div class="row mb-4">
<div class="col-6 d-flex align-items-center">
<button class="folder-wrapper__specification-sheet-top-btn js-show-specification-sheet-btn">
<span></span>
Specification sheet
</button>
<button class="folder-wrapper__info" data-toggle="modal" data-target="#specificationsSheetInfo">
<svg xmlns="http://www.w3.org/2000/svg" width="17.667" height="17.667" viewBox="0 0 17.667 17.667">
<g id="Info2Btn" transform="translate(-343 -723)">
<path id="Path_184" data-name="Path 184" d="M8.833,0a8.833,8.833,0,1,0,8.833,8.833A8.843,8.843,0,0,0,8.833,0Zm0,16.061a7.227,7.227,0,1,1,7.227-7.227A7.235,7.235,0,0,1,8.833,16.061Z" transform="translate(343 723)"/>
<path id="Path_185" data-name="Path 185" d="M146.072,70a1.071,1.071,0,1,0,1.07,1.071A1.072,1.072,0,0,0,146.072,70Z" transform="translate(205.761 656.747)"/>
<path id="Path_186" data-name="Path 186" d="M150.8,140a.8.8,0,0,0-.8.8v4.818a.8.8,0,0,0,1.606,0V140.8A.8.8,0,0,0,150.8,140Z" transform="translate(201.03 590.495)"/>
</g>
</svg>
</button>
</div>
<div class="col-6 text-right">
<div class="folder-wrapper__filters">
<div class="my-custom-select-wrapper">
<div class="my-custom-select">
<div class="my-custom-select__trigger"><span>Reorder by</span>
<div class="arrow"></div>
</div>
<div class="my-custom-options">
<span class="my-custom-option selected" data-value="Reorder by">Reorder by</span>
<span class="my-custom-option" data-value="Name">Name</span>
<span class="my-custom-option" data-value="Lastest">Lastest</span>
<span class="my-custom-option" data-value="Older">Older</span>
<span class="my-custom-option" data-value="Number of rooms">Number of rooms</span>
<span class="my-custom-option" data-value="Most visited">Most visited</span>
</div>
</div>
</div>

<div class="folder-wrapper__buttons">
<button class="shere">
<svg id="share" xmlns="http://www.w3.org/2000/svg" width="42.5" height="42.5" viewBox="0 0 42.5 42.5">
<path id="Path_226" data-name="Path 226" d="M2.5,0A2.5,2.5,0,1,1,0,2.5,2.5,2.5,0,0,1,2.5,0Z" transform="translate(10 19)" fill="#384765"></path>
<path id="Path_225" data-name="Path 225" d="M2.5,0A2.5,2.5,0,1,1,0,2.5,2.5,2.5,0,0,1,2.5,0Z" transform="translate(25 26)" fill="#384765"></path>
<path id="Path_224" data-name="Path 224" d="M2.5,0A2.5,2.5,0,1,1,0,2.5,2.5,2.5,0,0,1,2.5,0Z" transform="translate(25 11)" fill="#384765"></path>
<path id="Path_209" data-name="Path 209" d="M21.25,0A21.25,21.25,0,1,0,42.5,21.25,21.333,21.333,0,0,0,21.25,0ZM17.484,21.556l6.348,3.794a5.112,5.112,0,1,1-1.181,2.195l-5.96-3.562a5,5,0,1,1-.3-5.842l6.193-3.46a5.046,5.046,0,1,1,1.069,2.255L17.43,20.413a2.916,2.916,0,0,1,.054,1.143Z" fill="#384765"></path>
</svg>
</button>
<button class="delete" data-toggle="modal" data-target="#deleteFolder">
<svg xmlns="http://www.w3.org/2000/svg" width="43" height="43" viewBox="0 0 43 43">
<g id="trash" transform="translate(11.363 9.917)">
<circle id="Ellipse_36" data-name="Ellipse 36" cx="21.5" cy="21.5" r="21.5" transform="translate(-11.363 -9.917)" fill="#fb561b"></circle>
<path id="Path_408" data-name="Path 408" d="M63.808,128.863a1.849,1.849,0,0,0,1.914,1.655H73.9a1.882,1.882,0,0,0,1.947-1.687l1.33-13.886H62.186Z" transform="translate(-59.104 -107.806)" fill="#fff"></path>
<path id="Path_409" data-name="Path 409" d="M33.059,2.92H27.024V1.882A1.817,1.817,0,0,0,25.274,0H21.087a1.817,1.817,0,0,0-1.85,1.783q0,.049,0,.1V2.92H13.2a.649.649,0,0,0,0,1.3H33.059a.649.649,0,1,0,0-1.3ZM25.726,1.882V2.92H20.535V1.882a.519.519,0,0,1,.552-.584h4.088a.519.519,0,0,1,.554.481A.513.513,0,0,1,25.726,1.882Z" transform="translate(-12.554 0)" fill="#fff"></path>
</g>
</svg>
</button>
</div>
</div>
</div>
</div>
</div>
<div class="row">
<div class="col-12 js-saved-images-box">
<div class="folder-wrapper__saved-elements">

<!-- Specification sheet -->
<figure class="folder-wrapper__saved-element specification-sheet">
<figcaption class="folder-wrapper__saved-element--folders">
<span class="folder-wrapper__saved-element--folders-img">
<svg xmlns="http://www.w3.org/2000/svg" width="24.704" height="16.27" viewBox="0 0 24.704 16.27">
<g id="open-folder-black-and-white-variant" transform="translate(0 -87.578)">
<path id="Path_434" data-name="Path 434" d="M18.618,102.844a1.7,1.7,0,0,0,1.429-.84l4.57-8.648c.273-.526-.124-.84-.84-.84H19.163V90.451a1.3,1.3,0,0,0-1.293-1.293H6.573l-.838-2.2a.59.59,0,0,0-.551-.38H.6a.589.589,0,0,0-.59.593l.011,3.28L0,101.554a1.3,1.3,0,0,0,1.293,1.293m16.69-10.33H7.922a1.392,1.392,0,0,0-1.134.84l-4.109,8.311H1.293a.114.114,0,0,1-.114-.114v-13.8h3.6l.838,2.2a.59.59,0,0,0,.551.38h11.7a.114.114,0,0,1,.114.114v2.066Z" transform="translate(0 1)" fill="#fff"/>
</g>
</svg>
</span>
<div class="folder-wrapper__saved-element--buttons">
<button class="shere">
<svg xmlns="http://www.w3.org/2000/svg" width="23.547" height="25.688" viewBox="0 0 23.547 25.688"><defs><style>.share-white{fill:#fff;}</style></defs><g transform="translate(0)"><path class="share-white" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"/><path class="share-white" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"/><path class="share-white" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"/><path class="share-white" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"/><path class="share-white" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"/><path class="share-white" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"/><path class="share-white" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"/><path class="share-white" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"/></g></svg>
</button>
<button class="delete" data-toggle="modal" data-target="#deleteFolder">
<svg xmlns="http://www.w3.org/2000/svg" width="14.932" height="16.033" viewBox="0 0 14.932 16.033"><defs><style>.trash-white{fill:#fff;}</style></defs><g transform="translate(0 0)"><g transform="translate(0 0)"><g transform="translate(0 0)"><path class="trash-white" d="M63.331,124.769a1.305,1.305,0,0,0,1.351,1.168h5.771a1.328,1.328,0,0,0,1.374-1.191l.939-9.8H62.186Z" transform="translate(-60.01 -109.905)"/><path class="trash-white" d="M27.028,2.061h-4.26V1.328A1.283,1.283,0,0,0,21.533,0H18.577a1.282,1.282,0,0,0-1.306,1.259q0,.035,0,.07v.733h-4.26a.458.458,0,0,0,0,.916H27.028a.458.458,0,1,0,0-.916Zm-5.176-.733v.733H18.188V1.328a.366.366,0,0,1,.389-.412h2.886a.366.366,0,0,1,.391.34A.362.362,0,0,1,21.852,1.328Z" transform="translate(-12.554 0)"/></g></g></g></svg>
</button>
</div>
<p class="folder-wrapper__saved-element--text first">Specification sheet</p>
<button class="folder-wrapper__saved-element--folders-button"><span onClick="open_specs();">open folder</span></button>
</figcaption>
</figure>

<!-- Add Image url or upload -->			
<figure class="folder-wrapper__saved-element add-new-button js-url-modal-btn" data-tab-parrent="#v-pills-global" data-button-positon="room-name" data-toggle="modal" data-target="#newImageUrl">
<figcaption class="add-new-button__wrap">
<span class="svg-group">
<span class="svg-group__first">
<svg xmlns="http://www.w3.org/2000/svg" width="34.215" height="51.323" viewBox="0 0 34.215 51.323">
</svg>
</span>
<span class="svg-group__second">
<svg xmlns="http://www.w3.org/2000/svg" width="21.992" height="9.797" viewBox="0 0 21.992 9.797">
<path id="Path_448" data-name="Path 448" d="M20.286,207.506a1.764,1.764,0,0,0-1.764,1.764v4.5H3.586v-4.5a1.764,1.764,0,0,0-3.528,0v6.269A1.764,1.764,0,0,0,1.822,217.3H20.286a1.764,1.764,0,0,0,1.764-1.764V209.27A1.764,1.764,0,0,0,20.286,207.506Z" transform="translate(-0.058 -207.506)" fill="#fff"/>
</svg>
</span>
</span>
<p class="folder-wrapper__saved-element--folders-text">zzzzz Add an external URL of image or upload an image from the device</p>
</figcaption>
</figure>



<!-- product ? -->														
<figure class="folder-wrapper__saved-element">
<img src="<?php echo SITEROOT; ?>images/idea-folder-room-3.png" alt="" class="folder-wrapper__saved-element--img img-fluid">
<figcaption class="folder-wrapper__saved-element--text-box">
<a href="#" title="" class="folder-wrapper__saved-element--link"></a>
<div class="folder-wrapper__saved-element--buttons">
<button class="shere">
<svg xmlns="http://www.w3.org/2000/svg" width="23.547" height="25.688" viewBox="0 0 23.547 25.688"><defs><style>.share-white{fill:#fff;}</style></defs><g transform="translate(0)"><path class="share-white" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"/><path class="share-white" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"/><path class="share-white" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"/><path class="share-white" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"/><path class="share-white" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"/><path class="share-white" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"/><path class="share-white" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"/><path class="share-white" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"/></g></svg>
</button>
<button class="delete" data-toggle="modal" data-target="#deleteFolder">
<svg xmlns="http://www.w3.org/2000/svg" width="14.932" height="16.033" viewBox="0 0 14.932 16.033"><defs><style>.trash-white{fill:#fff;}</style></defs><g transform="translate(0 0)"><g transform="translate(0 0)"><g transform="translate(0 0)"><path class="trash-white" d="M63.331,124.769a1.305,1.305,0,0,0,1.351,1.168h5.771a1.328,1.328,0,0,0,1.374-1.191l.939-9.8H62.186Z" transform="translate(-60.01 -109.905)"/><path class="trash-white" d="M27.028,2.061h-4.26V1.328A1.283,1.283,0,0,0,21.533,0H18.577a1.282,1.282,0,0,0-1.306,1.259q0,.035,0,.07v.733h-4.26a.458.458,0,0,0,0,.916H27.028a.458.458,0,1,0,0-.916Zm-5.176-.733v.733H18.188V1.328a.366.366,0,0,1,.389-.412h2.886a.366.366,0,0,1,.391.34A.362.362,0,0,1,21.852,1.328Z" transform="translate(-12.554 0)"/></g></g></g></svg>
</button>
</div>
<p class="folder-wrapper__saved-element--text">Go to product details</p>
</figcaption>
</figure>

<!-- product ? -->														
<figure class="folder-wrapper__saved-element">
<img src="<?php echo SITEROOT; ?>images/idea-folder-room-4.png" alt="" class="folder-wrapper__saved-element--img img-fluid">
<figcaption class="folder-wrapper__saved-element--text-box">
<a href="#" title="" class="folder-wrapper__saved-element--link"></a>
<div class="folder-wrapper__saved-element--buttons">
<button class="shere">
<svg xmlns="http://www.w3.org/2000/svg" width="23.547" height="25.688" viewBox="0 0 23.547 25.688"><defs><style>.share-white{fill:#fff;}</style></defs><g transform="translate(0)"><path class="share-white" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"/><path class="share-white" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"/><path class="share-white" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"/><path class="share-white" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"/><path class="share-white" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"/><path class="share-white" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"/><path class="share-white" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"/><path class="share-white" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"/></g></svg>
</button>
<button class="delete" data-toggle="modal" data-target="#deleteFolder">
<svg xmlns="http://www.w3.org/2000/svg" width="14.932" height="16.033" viewBox="0 0 14.932 16.033"><defs><style>.trash-white{fill:#fff;}</style></defs><g transform="translate(0 0)"><g transform="translate(0 0)"><g transform="translate(0 0)"><path class="trash-white" d="M63.331,124.769a1.305,1.305,0,0,0,1.351,1.168h5.771a1.328,1.328,0,0,0,1.374-1.191l.939-9.8H62.186Z" transform="translate(-60.01 -109.905)"/><path class="trash-white" d="M27.028,2.061h-4.26V1.328A1.283,1.283,0,0,0,21.533,0H18.577a1.282,1.282,0,0,0-1.306,1.259q0,.035,0,.07v.733h-4.26a.458.458,0,0,0,0,.916H27.028a.458.458,0,1,0,0-.916Zm-5.176-.733v.733H18.188V1.328a.366.366,0,0,1,.389-.412h2.886a.366.366,0,0,1,.391.34A.362.362,0,0,1,21.852,1.328Z" transform="translate(-12.554 0)"/></g></g></g></svg>
</button>
</div>
<p class="folder-wrapper__saved-element--text">Go to product details</p>
</figcaption>
</figure>

<!-- product ? -->														
<figure class="folder-wrapper__saved-element">
<img src="<?php echo SITEROOT; ?>images/idea-folder-room-5.png" alt="" class="folder-wrapper__saved-element--img img-fluid">
<figcaption class="folder-wrapper__saved-element--text-box">
<a href="#" title="" class="folder-wrapper__saved-element--link"></a>
<div class="folder-wrapper__saved-element--buttons">
<button class="shere">
<svg xmlns="http://www.w3.org/2000/svg" width="23.547" height="25.688" viewBox="0 0 23.547 25.688"><defs><style>.share-white{fill:#fff;}</style></defs><g transform="translate(0)"><path class="share-white" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"/><path class="share-white" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"/><path class="share-white" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"/><path class="share-white" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"/><path class="share-white" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"/><path class="share-white" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"/><path class="share-white" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"/><path class="share-white" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"/></g></svg>
</button>
<button class="delete" data-toggle="modal" data-target="#deleteFolder">
<svg xmlns="http://www.w3.org/2000/svg" width="14.932" height="16.033" viewBox="0 0 14.932 16.033"><defs><style>.trash-white{fill:#fff;}</style></defs><g transform="translate(0 0)"><g transform="translate(0 0)"><g transform="translate(0 0)"><path class="trash-white" d="M63.331,124.769a1.305,1.305,0,0,0,1.351,1.168h5.771a1.328,1.328,0,0,0,1.374-1.191l.939-9.8H62.186Z" transform="translate(-60.01 -109.905)"/><path class="trash-white" d="M27.028,2.061h-4.26V1.328A1.283,1.283,0,0,0,21.533,0H18.577a1.282,1.282,0,0,0-1.306,1.259q0,.035,0,.07v.733h-4.26a.458.458,0,0,0,0,.916H27.028a.458.458,0,1,0,0-.916Zm-5.176-.733v.733H18.188V1.328a.366.366,0,0,1,.389-.412h2.886a.366.366,0,0,1,.391.34A.362.362,0,0,1,21.852,1.328Z" transform="translate(-12.554 0)"/></g></g></g></svg>
</button>
</div>
<p class="folder-wrapper__saved-element--text">Go to product details</p>
</figcaption>
</figure>


<!-- go to a items for folder  ? -->														
<figure class="folder-wrapper__saved-element folders">
<figcaption class="folder-wrapper__saved-element--folders">
<span class="folder-wrapper__saved-element--folders-img">
<svg xmlns="http://www.w3.org/2000/svg" width="86" height="71.044" viewBox="0 0 86 71.044"><defs><style>.folder-orange{fill:#edb700;}</style></defs><g transform="translate(-10.667)"><g transform="translate(10.667 7.478)"><g transform="translate(0)"><path class="folder-orange" d="M87.319,53.884H44.1a5.6,5.6,0,0,1-5.321-3.836l-.329-.991a9.337,9.337,0,0,0-8.865-6.39H20.015a9.361,9.361,0,0,0-9.348,9.348v44.87a9.358,9.358,0,0,0,9.348,9.348H34.971a1.87,1.87,0,1,0,0-3.739H20.015a5.615,5.615,0,0,1-5.609-5.609V52.015a5.615,5.615,0,0,1,5.609-5.609h9.568A5.6,5.6,0,0,1,34.9,50.239l.333.995a9.337,9.337,0,0,0,8.865,6.39H87.319a5.615,5.615,0,0,1,5.609,5.609V96.884a5.615,5.615,0,0,1-5.609,5.609H72.363a1.87,1.87,0,0,0,0,3.739H87.319a9.356,9.356,0,0,0,9.348-9.348V63.232A9.358,9.358,0,0,0,87.319,53.884Z" transform="translate(-10.667 -42.667)"/></g></g><g transform="translate(14.406)"><path class="folder-orange" d="M101.174,0H41.348A9.361,9.361,0,0,0,32,9.348a1.87,1.87,0,0,0,3.739,0,5.615,5.615,0,0,1,5.609-5.609h59.826a5.615,5.615,0,0,1,5.609,5.609V20.565a1.87,1.87,0,1,0,3.739,0V9.348A9.359,9.359,0,0,0,101.174,0Z" transform="translate(-32)"/></g></g></svg>
</span>
<p class="folder-wrapper__saved-element--folders-text">Nice things for living room</p>
<button class="folder-wrapper__saved-element--folders-button js-show-add-to-rooms-new-idea-folder-images-btn">View folder</button>
</figcaption>
</figure>


<!-- product ? -->														
<figure class="folder-wrapper__saved-element">
<img src="<?php echo SITEROOT; ?>images/idea-folder-room-2.png" alt="" class="folder-wrapper__saved-element--img img-fluid">
<figcaption class="folder-wrapper__saved-element--text-box">
<a href="#" title="" class="folder-wrapper__saved-element--link"></a>
<div class="folder-wrapper__saved-element--buttons">
<button class="shere">
<svg xmlns="http://www.w3.org/2000/svg" width="23.547" height="25.688" viewBox="0 0 23.547 25.688"><defs><style>.share-white{fill:#fff;}</style></defs><g transform="translate(0)"><path class="share-white" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"/><path class="share-white" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"/><path class="share-white" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"/><path class="share-white" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"/><path class="share-white" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"/><path class="share-white" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"/><path class="share-white" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"/><path class="share-white" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"/></g></svg>
</button>
<button class="delete" data-toggle="modal" data-target="#deleteFolder">
<svg xmlns="http://www.w3.org/2000/svg" width="14.932" height="16.033" viewBox="0 0 14.932 16.033"><defs><style>.trash-white{fill:#fff;}</style></defs><g transform="translate(0 0)"><g transform="translate(0 0)"><g transform="translate(0 0)"><path class="trash-white" d="M63.331,124.769a1.305,1.305,0,0,0,1.351,1.168h5.771a1.328,1.328,0,0,0,1.374-1.191l.939-9.8H62.186Z" transform="translate(-60.01 -109.905)"/><path class="trash-white" d="M27.028,2.061h-4.26V1.328A1.283,1.283,0,0,0,21.533,0H18.577a1.282,1.282,0,0,0-1.306,1.259q0,.035,0,.07v.733h-4.26a.458.458,0,0,0,0,.916H27.028a.458.458,0,1,0,0-.916Zm-5.176-.733v.733H18.188V1.328a.366.366,0,0,1,.389-.412h2.886a.366.366,0,0,1,.391.34A.362.362,0,0,1,21.852,1.328Z" transform="translate(-12.554 0)"/></g></g></g></svg>
</button>
</div>
<p class="folder-wrapper__saved-element--text">Go to product details</p>
</figcaption>
</figure>
</div>
</div>


<div class="col-12 js-specification-sheet-box" style="display: none;">
<div class="folder-wrapper__specification-sheet--wrapper">
<div class="folder-wrapper__specification-sheet--buttons-box">
<div class="folder-wrapper__specification-sheet--buttons-box-content">
<span class="folder-wrapper__specification-sheet--buttons-box-image">
<svg xmlns="http://www.w3.org/2000/svg" width="24.704" height="16.27" viewBox="0 0 24.704 16.27">
<g id="open-folder-black-and-white-variant" transform="translate(0 -87.578)">
<path id="Path_434" data-name="Path 434" d="M18.618,102.844a1.7,1.7,0,0,0,1.429-.84l4.57-8.648c.273-.526-.124-.84-.84-.84H19.163V90.451a1.3,1.3,0,0,0-1.293-1.293H6.573l-.838-2.2a.59.59,0,0,0-.551-.38H.6a.589.589,0,0,0-.59.593l.011,3.28L0,101.554a1.3,1.3,0,0,0,1.293,1.293m16.69-10.33H7.922a1.392,1.392,0,0,0-1.134.84l-4.109,8.311H1.293a.114.114,0,0,1-.114-.114v-13.8h3.6l.838,2.2a.59.59,0,0,0,.551.38h11.7a.114.114,0,0,1,.114.114v2.066Z" transform="translate(0 1)" fill="#fff"/>
</g>
</svg>
</span>

<button class="folder-wrapper__specification-sheet--button js-hide-specification-sheet-box-btn">
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 495.785 495.785" xml:space="preserve"><path id="XMLID_26_" d="M436.855,90.337L255.175,0.541c-1.62-0.801-3.533-0.707-5.084,0.249c-1.535,0.957-2.467,2.638-2.467,4.449  v36.834H56.017v453.713h105.924V147.996h85.684v36.833c0,1.812,0.932,3.492,2.467,4.449c1.551,0.956,3.464,1.052,5.084,0.249  l181.68-89.796c1.791-0.888,2.914-2.706,2.914-4.698C439.769,93.043,438.646,91.225,436.855,90.337z"/><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
Specification sheet
</button>
</div>

<div class="d-flex justify-content-center align-items-center">
<div class="house-checkbox">
<input class="custom-checkbox js-load-confirm-modal" id="checkbox-2" type="checkbox" value="value2" data-target="#confirmModal">
<label for="checkbox-2">Share with Closets To Go</label>
</div>
<button class="folder-wrapper__specification-sheet--button second-button js-hide-specification-sheet-box-btn">
Back
</button>
</div>
</div>

<div class="folder-wrapper__specification-sheet--wrapper-content">
<h3 class="folder-wrapper__specification-sheet--wrapper-heading">Accessory</h3>				
<div class="folder-wrapper__specification-sheet--wrapper-image-wrap">
<figure class="folder-wrapper__specification-sheet--wrapper-image-box">
<img src="<?php echo SITEROOT; ?>images/idea-folder-room-5.png" alt="" class="folder-wrapper__specification-sheet--wrapper-image-img img-fluid">
<figcaption class="folder-wrapper__specification-sheet--wrapper-image-content">
<div class="folder-wrapper__specification-sheet--wrapper-image-buttons">
<button class="shere">
<svg xmlns="http://www.w3.org/2000/svg" width="23.547" height="25.688" viewBox="0 0 23.547 25.688"><defs><style>.share-white{fill:#fff;}</style></defs><g transform="translate(0)"><path class="share-white" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"/><path class="share-white" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"/><path class="share-white" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"/><path class="share-white" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"/><path class="share-white" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"/><path class="share-white" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"/><path class="share-white" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"/><path class="share-white" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"/></g></svg>
</button>
<button class="delete" data-toggle="modal" data-target="#deleteFolder">
<svg xmlns="http://www.w3.org/2000/svg" width="14.932" height="16.033" viewBox="0 0 14.932 16.033"><defs><style>.trash-white{fill:#fff;}</style></defs><g transform="translate(0 0)"><g transform="translate(0 0)"><g transform="translate(0 0)"><path class="trash-white" d="M63.331,124.769a1.305,1.305,0,0,0,1.351,1.168h5.771a1.328,1.328,0,0,0,1.374-1.191l.939-9.8H62.186Z" transform="translate(-60.01 -109.905)"/><path class="trash-white" d="M27.028,2.061h-4.26V1.328A1.283,1.283,0,0,0,21.533,0H18.577a1.282,1.282,0,0,0-1.306,1.259q0,.035,0,.07v.733h-4.26a.458.458,0,0,0,0,.916H27.028a.458.458,0,1,0,0-.916Zm-5.176-.733v.733H18.188V1.328a.366.366,0,0,1,.389-.412h2.886a.366.366,0,0,1,.391.34A.362.362,0,0,1,21.852,1.328Z" transform="translate(-12.554 0)"/></g></g></g></svg>
</button>
</div>
<p class="folder-wrapper__specification-sheet--wrapper-image-text">Go to product details</p>
</figcaption>
</figure>


<figure class="folder-wrapper__specification-sheet--wrapper-image-box">
<img src="<?php echo SITEROOT; ?>images/idea-folder-room-2.png" alt="" class="folder-wrapper__specification-sheet--wrapper-image-img img-fluid">
<figcaption class="folder-wrapper__specification-sheet--wrapper-image-content">
<div class="folder-wrapper__specification-sheet--wrapper-image-buttons">
<button class="shere">
<svg xmlns="http://www.w3.org/2000/svg" width="23.547" height="25.688" viewBox="0 0 23.547 25.688"><defs><style>.share-white{fill:#fff;}</style></defs><g transform="translate(0)"><path class="share-white" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"/><path class="share-white" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"/><path class="share-white" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"/><path class="share-white" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"/><path class="share-white" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"/><path class="share-white" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"/><path class="share-white" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"/><path class="share-white" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"/></g></svg>
</button>
<button class="delete" data-toggle="modal" data-target="#deleteFolder">
<svg xmlns="http://www.w3.org/2000/svg" width="14.932" height="16.033" viewBox="0 0 14.932 16.033"><defs><style>.trash-white{fill:#fff;}</style></defs><g transform="translate(0 0)"><g transform="translate(0 0)"><g transform="translate(0 0)"><path class="trash-white" d="M63.331,124.769a1.305,1.305,0,0,0,1.351,1.168h5.771a1.328,1.328,0,0,0,1.374-1.191l.939-9.8H62.186Z" transform="translate(-60.01 -109.905)"/><path class="trash-white" d="M27.028,2.061h-4.26V1.328A1.283,1.283,0,0,0,21.533,0H18.577a1.282,1.282,0,0,0-1.306,1.259q0,.035,0,.07v.733h-4.26a.458.458,0,0,0,0,.916H27.028a.458.458,0,1,0,0-.916Zm-5.176-.733v.733H18.188V1.328a.366.366,0,0,1,.389-.412h2.886a.366.366,0,0,1,.391.34A.362.362,0,0,1,21.852,1.328Z" transform="translate(-12.554 0)"/></g></g></g></svg>
</button>
</div>
<p class="folder-wrapper__specification-sheet--wrapper-image-text">Go to product details</p>
</figcaption>
</figure>

<figure class="folder-wrapper__specification-sheet--wrapper-image-box">
<img src="<?php echo SITEROOT; ?>images/idea-folder-room-3.png" alt="" class="folder-wrapper__specification-sheet--wrapper-image-img img-fluid">
<figcaption class="folder-wrapper__specification-sheet--wrapper-image-content">
<div class="folder-wrapper__specification-sheet--wrapper-image-buttons">
<button class="shere">
<svg xmlns="http://www.w3.org/2000/svg" width="23.547" height="25.688" viewBox="0 0 23.547 25.688"><defs><style>.share-white{fill:#fff;}</style></defs><g transform="translate(0)"><path class="share-white" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"/><path class="share-white" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"/><path class="share-white" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"/><path class="share-white" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"/><path class="share-white" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"/><path class="share-white" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"/><path class="share-white" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"/><path class="share-white" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"/></g></svg>
</button>
<button class="delete" data-toggle="modal" data-target="#deleteFolder">
<svg xmlns="http://www.w3.org/2000/svg" width="14.932" height="16.033" viewBox="0 0 14.932 16.033"><defs><style>.trash-white{fill:#fff;}</style></defs><g transform="translate(0 0)"><g transform="translate(0 0)"><g transform="translate(0 0)"><path class="trash-white" d="M63.331,124.769a1.305,1.305,0,0,0,1.351,1.168h5.771a1.328,1.328,0,0,0,1.374-1.191l.939-9.8H62.186Z" transform="translate(-60.01 -109.905)"/><path class="trash-white" d="M27.028,2.061h-4.26V1.328A1.283,1.283,0,0,0,21.533,0H18.577a1.282,1.282,0,0,0-1.306,1.259q0,.035,0,.07v.733h-4.26a.458.458,0,0,0,0,.916H27.028a.458.458,0,1,0,0-.916Zm-5.176-.733v.733H18.188V1.328a.366.366,0,0,1,.389-.412h2.886a.366.366,0,0,1,.391.34A.362.362,0,0,1,21.852,1.328Z" transform="translate(-12.554 0)"/></g></g></g></svg>
</button>
</div>
<p class="folder-wrapper__specification-sheet--wrapper-image-text">Go to product details</p>
</figcaption>
</figure>

</div>

<?php
//print_r($spec_array);
?>

<h3 class="folder-wrapper__specification-sheet--wrapper-heading">Material color</h3>
<p class="folder-wrapper__specification-sheet--wrapper-text">Closet organizers are the ultimate do it yourself project. They not only make your life simpler, they also bring about a lifetime of satisfaction. The Closets To Go closet organizers are the easiest to design and assemble. From our easy-to-adjust hanging bracket to the pre-assembly of all your hardware fittings and labeled panels, we've virtually made reading instructions a thing of the past. Our custom closet organizers are the easiest to install in the nation, guaranteed! They're also constructed with high-quality, environmentally-friendly materials made right here in the United States.</p>
<div class="folder-wrapper__specification-sheet--wrapper-image-wrap">
<figure class="folder-wrapper__specification-sheet--wrapper-image-box">
<img src="<?php echo SITEROOT; ?>images/idea-folder-room-5.png" alt="" class="folder-wrapper__specification-sheet--wrapper-image-img img-fluid">

<figcaption class="folder-wrapper__specification-sheet--wrapper-image-content">
<div class="folder-wrapper__specification-sheet--wrapper-image-buttons">
<button class="shere">
<svg xmlns="http://www.w3.org/2000/svg" width="23.547" height="25.688" viewBox="0 0 23.547 25.688"><defs><style>.share-white{fill:#fff;}</style></defs><g transform="translate(0)"><path class="share-white" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"/><path class="share-white" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"/><path class="share-white" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"/><path class="share-white" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"/><path class="share-white" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"/><path class="share-white" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"/><path class="share-white" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"/><path class="share-white" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"/></g></svg>
</button>
<button class="delete" data-toggle="modal" data-target="#deleteFolder">
<svg xmlns="http://www.w3.org/2000/svg" width="14.932" height="16.033" viewBox="0 0 14.932 16.033"><defs><style>.trash-white{fill:#fff;}</style></defs><g transform="translate(0 0)"><g transform="translate(0 0)"><g transform="translate(0 0)"><path class="trash-white" d="M63.331,124.769a1.305,1.305,0,0,0,1.351,1.168h5.771a1.328,1.328,0,0,0,1.374-1.191l.939-9.8H62.186Z" transform="translate(-60.01 -109.905)"/><path class="trash-white" d="M27.028,2.061h-4.26V1.328A1.283,1.283,0,0,0,21.533,0H18.577a1.282,1.282,0,0,0-1.306,1.259q0,.035,0,.07v.733h-4.26a.458.458,0,0,0,0,.916H27.028a.458.458,0,1,0,0-.916Zm-5.176-.733v.733H18.188V1.328a.366.366,0,0,1,.389-.412h2.886a.366.366,0,0,1,.391.34A.362.362,0,0,1,21.852,1.328Z" transform="translate(-12.554 0)"/></g></g></g></svg>
</button>
</div>
<p class="folder-wrapper__specification-sheet--wrapper-image-text">Go to product details</p>
</figcaption>
</figure>

<figure class="folder-wrapper__specification-sheet--wrapper-image-box">
<img src="<?php echo SITEROOT; ?>images/idea-folder-room-2.png" alt="" class="folder-wrapper__specification-sheet--wrapper-image-img img-fluid">

<figcaption class="folder-wrapper__specification-sheet--wrapper-image-content">
<div class="folder-wrapper__specification-sheet--wrapper-image-buttons">
<button class="shere">
<svg xmlns="http://www.w3.org/2000/svg" width="23.547" height="25.688" viewBox="0 0 23.547 25.688"><defs><style>.share-white{fill:#fff;}</style></defs><g transform="translate(0)"><path class="share-white" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"/><path class="share-white" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"/><path class="share-white" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"/><path class="share-white" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"/><path class="share-white" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"/><path class="share-white" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"/><path class="share-white" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"/><path class="share-white" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"/></g></svg>
</button>
<button class="delete" data-toggle="modal" data-target="#deleteFolder">
<svg xmlns="http://www.w3.org/2000/svg" width="14.932" height="16.033" viewBox="0 0 14.932 16.033"><defs><style>.trash-white{fill:#fff;}</style></defs><g transform="translate(0 0)"><g transform="translate(0 0)"><g transform="translate(0 0)"><path class="trash-white" d="M63.331,124.769a1.305,1.305,0,0,0,1.351,1.168h5.771a1.328,1.328,0,0,0,1.374-1.191l.939-9.8H62.186Z" transform="translate(-60.01 -109.905)"/><path class="trash-white" d="M27.028,2.061h-4.26V1.328A1.283,1.283,0,0,0,21.533,0H18.577a1.282,1.282,0,0,0-1.306,1.259q0,.035,0,.07v.733h-4.26a.458.458,0,0,0,0,.916H27.028a.458.458,0,1,0,0-.916Zm-5.176-.733v.733H18.188V1.328a.366.366,0,0,1,.389-.412h2.886a.366.366,0,0,1,.391.34A.362.362,0,0,1,21.852,1.328Z" transform="translate(-12.554 0)"/></g></g></g></svg>
</button>
</div>
<p class="folder-wrapper__specification-sheet--wrapper-image-text">Go to product details</p>
</figcaption>
</figure>

<figure class="folder-wrapper__specification-sheet--wrapper-image-box">
<img src="<?php echo SITEROOT; ?>images/idea-folder-room-3.png" alt="" class="folder-wrapper__specification-sheet--wrapper-image-img img-fluid">

<figcaption class="folder-wrapper__specification-sheet--wrapper-image-content">
<div class="folder-wrapper__specification-sheet--wrapper-image-buttons">
<button class="shere">
<svg xmlns="http://www.w3.org/2000/svg" width="23.547" height="25.688" viewBox="0 0 23.547 25.688"><defs><style>.share-white{fill:#fff;}</style></defs><g transform="translate(0)"><path class="share-white" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"/><path class="share-white" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"/><path class="share-white" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"/><path class="share-white" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"/><path class="share-white" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"/><path class="share-white" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"/><path class="share-white" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"/><path class="share-white" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"/></g></svg>
</button>
<button class="delete" data-toggle="modal" data-target="#deleteFolder">
<svg xmlns="http://www.w3.org/2000/svg" width="14.932" height="16.033" viewBox="0 0 14.932 16.033"><defs><style>.trash-white{fill:#fff;}</style></defs><g transform="translate(0 0)"><g transform="translate(0 0)"><g transform="translate(0 0)"><path class="trash-white" d="M63.331,124.769a1.305,1.305,0,0,0,1.351,1.168h5.771a1.328,1.328,0,0,0,1.374-1.191l.939-9.8H62.186Z" transform="translate(-60.01 -109.905)"/><path class="trash-white" d="M27.028,2.061h-4.26V1.328A1.283,1.283,0,0,0,21.533,0H18.577a1.282,1.282,0,0,0-1.306,1.259q0,.035,0,.07v.733h-4.26a.458.458,0,0,0,0,.916H27.028a.458.458,0,1,0,0-.916Zm-5.176-.733v.733H18.188V1.328a.366.366,0,0,1,.389-.412h2.886a.366.366,0,0,1,.391.34A.362.362,0,0,1,21.852,1.328Z" transform="translate(-12.554 0)"/></g></g></g></svg>
</button>
</div>
<p class="folder-wrapper__specification-sheet--wrapper-image-text">Go to product details</p>
</figcaption>
</figure>

<figure class="folder-wrapper__specification-sheet--wrapper-image-box">
<img src="<?php echo SITEROOT; ?>images/idea-folder-room-4.png" alt="" class="folder-wrapper__specification-sheet--wrapper-image-img img-fluid">

<figcaption class="folder-wrapper__specification-sheet--wrapper-image-content">
<div class="folder-wrapper__specification-sheet--wrapper-image-buttons">
<button class="shere">
<svg xmlns="http://www.w3.org/2000/svg" width="23.547" height="25.688" viewBox="0 0 23.547 25.688"><defs><style>.share-white{fill:#fff;}</style></defs><g transform="translate(0)"><path class="share-white" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"/><path class="share-white" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"/><path class="share-white" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"/><path class="share-white" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"/><path class="share-white" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"/><path class="share-white" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"/><path class="share-white" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"/><path class="share-white" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"/></g></svg>
</button>
<button class="delete" data-toggle="modal" data-target="#deleteFolder">
<svg xmlns="http://www.w3.org/2000/svg" width="14.932" height="16.033" viewBox="0 0 14.932 16.033"><defs><style>.trash-white{fill:#fff;}</style></defs><g transform="translate(0 0)"><g transform="translate(0 0)"><g transform="translate(0 0)"><path class="trash-white" d="M63.331,124.769a1.305,1.305,0,0,0,1.351,1.168h5.771a1.328,1.328,0,0,0,1.374-1.191l.939-9.8H62.186Z" transform="translate(-60.01 -109.905)"/><path class="trash-white" d="M27.028,2.061h-4.26V1.328A1.283,1.283,0,0,0,21.533,0H18.577a1.282,1.282,0,0,0-1.306,1.259q0,.035,0,.07v.733h-4.26a.458.458,0,0,0,0,.916H27.028a.458.458,0,1,0,0-.916Zm-5.176-.733v.733H18.188V1.328a.366.366,0,0,1,.389-.412h2.886a.366.366,0,0,1,.391.34A.362.362,0,0,1,21.852,1.328Z" transform="translate(-12.554 0)"/></g></g></g></svg>
</button>
</div>
<p class="folder-wrapper__specification-sheet--wrapper-image-text">Go to product details</p>
</figcaption>
</figure>
</div>

<h3 class="folder-wrapper__specification-sheet--wrapper-heading">Door/drawer style</h3>

<p class="folder-wrapper__specification-sheet--wrapper-text">There is no any items in category.</p>

<h3 class="folder-wrapper__specification-sheet--wrapper-heading">Decorative hardware (handles, knobs, hooks)</h3>

<div class="folder-wrapper__specification-sheet--wrapper-image-wrap">
<figure class="folder-wrapper__specification-sheet--wrapper-image-box">
<img src="<?php echo SITEROOT; ?>images/idea-folder-room-5.png" alt="" class="folder-wrapper__specification-sheet--wrapper-image-img img-fluid">

<figcaption class="folder-wrapper__specification-sheet--wrapper-image-content">
<div class="folder-wrapper__specification-sheet--wrapper-image-buttons">
<button class="shere">
<svg xmlns="http://www.w3.org/2000/svg" width="23.547" height="25.688" viewBox="0 0 23.547 25.688"><defs><style>.share-white{fill:#fff;}</style></defs><g transform="translate(0)"><path class="share-white" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"/><path class="share-white" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"/><path class="share-white" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"/><path class="share-white" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"/><path class="share-white" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"/><path class="share-white" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"/><path class="share-white" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"/><path class="share-white" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"/></g></svg>
</button>
<button class="delete" data-toggle="modal" data-target="#deleteFolder">
<svg xmlns="http://www.w3.org/2000/svg" width="14.932" height="16.033" viewBox="0 0 14.932 16.033"><defs><style>.trash-white{fill:#fff;}</style></defs><g transform="translate(0 0)"><g transform="translate(0 0)"><g transform="translate(0 0)"><path class="trash-white" d="M63.331,124.769a1.305,1.305,0,0,0,1.351,1.168h5.771a1.328,1.328,0,0,0,1.374-1.191l.939-9.8H62.186Z" transform="translate(-60.01 -109.905)"/><path class="trash-white" d="M27.028,2.061h-4.26V1.328A1.283,1.283,0,0,0,21.533,0H18.577a1.282,1.282,0,0,0-1.306,1.259q0,.035,0,.07v.733h-4.26a.458.458,0,0,0,0,.916H27.028a.458.458,0,1,0,0-.916Zm-5.176-.733v.733H18.188V1.328a.366.366,0,0,1,.389-.412h2.886a.366.366,0,0,1,.391.34A.362.362,0,0,1,21.852,1.328Z" transform="translate(-12.554 0)"/></g></g></g></svg>
</button>
</div>
<p class="folder-wrapper__specification-sheet--wrapper-image-text">Go to product details</p>
</figcaption>
</figure>

<figure class="folder-wrapper__specification-sheet--wrapper-image-box">
<img src="<?php echo SITEROOT; ?>images/idea-folder-room-2.png" alt="" class="folder-wrapper__specification-sheet--wrapper-image-img img-fluid">

<figcaption class="folder-wrapper__specification-sheet--wrapper-image-content">
<div class="folder-wrapper__specification-sheet--wrapper-image-buttons">
<button class="shere">
<svg xmlns="http://www.w3.org/2000/svg" width="23.547" height="25.688" viewBox="0 0 23.547 25.688"><defs><style>.share-white{fill:#fff;}</style></defs><g transform="translate(0)"><path class="share-white" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"/><path class="share-white" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"/><path class="share-white" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"/><path class="share-white" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"/><path class="share-white" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"/><path class="share-white" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"/><path class="share-white" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"/><path class="share-white" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"/></g></svg>
</button>
<button class="delete" data-toggle="modal" data-target="#deleteFolder">
<svg xmlns="http://www.w3.org/2000/svg" width="14.932" height="16.033" viewBox="0 0 14.932 16.033"><defs><style>.trash-white{fill:#fff;}</style></defs><g transform="translate(0 0)"><g transform="translate(0 0)"><g transform="translate(0 0)"><path class="trash-white" d="M63.331,124.769a1.305,1.305,0,0,0,1.351,1.168h5.771a1.328,1.328,0,0,0,1.374-1.191l.939-9.8H62.186Z" transform="translate(-60.01 -109.905)"/><path class="trash-white" d="M27.028,2.061h-4.26V1.328A1.283,1.283,0,0,0,21.533,0H18.577a1.282,1.282,0,0,0-1.306,1.259q0,.035,0,.07v.733h-4.26a.458.458,0,0,0,0,.916H27.028a.458.458,0,1,0,0-.916Zm-5.176-.733v.733H18.188V1.328a.366.366,0,0,1,.389-.412h2.886a.366.366,0,0,1,.391.34A.362.362,0,0,1,21.852,1.328Z" transform="translate(-12.554 0)"/></g></g></g></svg>
</button>
</div>
<p class="folder-wrapper__specification-sheet--wrapper-image-text">Go to product details</p>
</figcaption>
</figure>
</div>

<h3 class="folder-wrapper__specification-sheet--wrapper-heading">Wardrobe tube style and finish</h3>

<p class="folder-wrapper__specification-sheet--wrapper-text">Closet organizers are the ultimate do it yourself project. They not only make your life simpler, they also bring about a lifetime of satisfaction. The Closets To Go closet organizers are the easiest to design and assemble. From our easy-to-adjust hanging bracket to the pre-assembly of all your hardware fittings and labeled panels, we've virtually made reading instructions a thing of the past. Our custom closet organizers are the easiest to install in the nation, guaranteed! They're also constructed with high-quality, environmentally-friendly materials made right here in the United States.</p>

<div class="folder-wrapper__specification-sheet--wrapper-image-wrap">
<figure class="folder-wrapper__specification-sheet--wrapper-image-box">
<img src="<?php echo SITEROOT; ?>images/idea-folder-room-5.png" alt="" class="folder-wrapper__specification-sheet--wrapper-image-img img-fluid">

<figcaption class="folder-wrapper__specification-sheet--wrapper-image-content">
<div class="folder-wrapper__specification-sheet--wrapper-image-buttons">
<button class="shere">
<svg xmlns="http://www.w3.org/2000/svg" width="23.547" height="25.688" viewBox="0 0 23.547 25.688"><defs><style>.share-white{fill:#fff;}</style></defs><g transform="translate(0)"><path class="share-white" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"/><path class="share-white" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"/><path class="share-white" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"/><path class="share-white" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"/><path class="share-white" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"/><path class="share-white" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"/><path class="share-white" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"/><path class="share-white" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"/></g></svg>
</button>
<button class="delete" data-toggle="modal" data-target="#deleteFolder">
<svg xmlns="http://www.w3.org/2000/svg" width="14.932" height="16.033" viewBox="0 0 14.932 16.033"><defs><style>.trash-white{fill:#fff;}</style></defs><g transform="translate(0 0)"><g transform="translate(0 0)"><g transform="translate(0 0)"><path class="trash-white" d="M63.331,124.769a1.305,1.305,0,0,0,1.351,1.168h5.771a1.328,1.328,0,0,0,1.374-1.191l.939-9.8H62.186Z" transform="translate(-60.01 -109.905)"/><path class="trash-white" d="M27.028,2.061h-4.26V1.328A1.283,1.283,0,0,0,21.533,0H18.577a1.282,1.282,0,0,0-1.306,1.259q0,.035,0,.07v.733h-4.26a.458.458,0,0,0,0,.916H27.028a.458.458,0,1,0,0-.916Zm-5.176-.733v.733H18.188V1.328a.366.366,0,0,1,.389-.412h2.886a.366.366,0,0,1,.391.34A.362.362,0,0,1,21.852,1.328Z" transform="translate(-12.554 0)"/></g></g></g></svg>
</button>
</div>
<p class="folder-wrapper__specification-sheet--wrapper-image-text">Go to product details</p>
</figcaption>
</figure>

<figure class="folder-wrapper__specification-sheet--wrapper-image-box">
<img src="<?php echo SITEROOT; ?>images/idea-folder-room-2.png" alt="" class="folder-wrapper__specification-sheet--wrapper-image-img img-fluid">

<figcaption class="folder-wrapper__specification-sheet--wrapper-image-content">
<div class="folder-wrapper__specification-sheet--wrapper-image-buttons">
<button class="shere">
<svg xmlns="http://www.w3.org/2000/svg" width="23.547" height="25.688" viewBox="0 0 23.547 25.688"><defs><style>.share-white{fill:#fff;}</style></defs><g transform="translate(0)"><path class="share-white" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"/><path class="share-white" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"/><path class="share-white" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"/><path class="share-white" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"/><path class="share-white" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"/><path class="share-white" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"/><path class="share-white" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"/><path class="share-white" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"/></g></svg>
</button>
<button class="delete" data-toggle="modal" data-target="#deleteFolder">
<svg xmlns="http://www.w3.org/2000/svg" width="14.932" height="16.033" viewBox="0 0 14.932 16.033"><defs><style>.trash-white{fill:#fff;}</style></defs><g transform="translate(0 0)"><g transform="translate(0 0)"><g transform="translate(0 0)"><path class="trash-white" d="M63.331,124.769a1.305,1.305,0,0,0,1.351,1.168h5.771a1.328,1.328,0,0,0,1.374-1.191l.939-9.8H62.186Z" transform="translate(-60.01 -109.905)"/><path class="trash-white" d="M27.028,2.061h-4.26V1.328A1.283,1.283,0,0,0,21.533,0H18.577a1.282,1.282,0,0,0-1.306,1.259q0,.035,0,.07v.733h-4.26a.458.458,0,0,0,0,.916H27.028a.458.458,0,1,0,0-.916Zm-5.176-.733v.733H18.188V1.328a.366.366,0,0,1,.389-.412h2.886a.366.366,0,0,1,.391.34A.362.362,0,0,1,21.852,1.328Z" transform="translate(-12.554 0)"/></g></g></g></svg>
</button>
</div>
<p class="folder-wrapper__specification-sheet--wrapper-image-text">Go to product details</p>
</figcaption>
</figure>

<figure class="folder-wrapper__specification-sheet--wrapper-image-box">
<img src="<?php echo SITEROOT; ?>images/idea-folder-room-3.png" alt="" class="folder-wrapper__specification-sheet--wrapper-image-img img-fluid">

<figcaption class="folder-wrapper__specification-sheet--wrapper-image-content">
<div class="folder-wrapper__specification-sheet--wrapper-image-buttons">
<button class="shere">
<svg xmlns="http://www.w3.org/2000/svg" width="23.547" height="25.688" viewBox="0 0 23.547 25.688"><defs><style>.share-white{fill:#fff;}</style></defs><g transform="translate(0)"><path class="share-white" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"/><path class="share-white" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"/><path class="share-white" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"/><path class="share-white" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"/><path class="share-white" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"/><path class="share-white" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"/><path class="share-white" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"/><path class="share-white" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"/></g></svg>
</button>
<button class="delete" data-toggle="modal" data-target="#deleteFolder">
<svg xmlns="http://www.w3.org/2000/svg" width="14.932" height="16.033" viewBox="0 0 14.932 16.033"><defs><style>.trash-white{fill:#fff;}</style></defs><g transform="translate(0 0)"><g transform="translate(0 0)"><g transform="translate(0 0)"><path class="trash-white" d="M63.331,124.769a1.305,1.305,0,0,0,1.351,1.168h5.771a1.328,1.328,0,0,0,1.374-1.191l.939-9.8H62.186Z" transform="translate(-60.01 -109.905)"/><path class="trash-white" d="M27.028,2.061h-4.26V1.328A1.283,1.283,0,0,0,21.533,0H18.577a1.282,1.282,0,0,0-1.306,1.259q0,.035,0,.07v.733h-4.26a.458.458,0,0,0,0,.916H27.028a.458.458,0,1,0,0-.916Zm-5.176-.733v.733H18.188V1.328a.366.366,0,0,1,.389-.412h2.886a.366.366,0,0,1,.391.34A.362.362,0,0,1,21.852,1.328Z" transform="translate(-12.554 0)"/></g></g></g></svg>
</button>
</div>
<p class="folder-wrapper__specification-sheet--wrapper-image-text">Go to product details</p>
</figcaption>
</figure>

<figure class="folder-wrapper__specification-sheet--wrapper-image-box">
<img src="<?php echo SITEROOT; ?>images/idea-folder-room-4.png" alt="" class="folder-wrapper__specification-sheet--wrapper-image-img img-fluid">

<figcaption class="folder-wrapper__specification-sheet--wrapper-image-content">
<div class="folder-wrapper__specification-sheet--wrapper-image-buttons">
<button class="shere">
<svg xmlns="http://www.w3.org/2000/svg" width="23.547" height="25.688" viewBox="0 0 23.547 25.688"><defs><style>.share-white{fill:#fff;}</style></defs><g transform="translate(0)"><path class="share-white" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"/><path class="share-white" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"/><path class="share-white" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"/><path class="share-white" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"/><path class="share-white" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"/><path class="share-white" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"/><path class="share-white" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"/><path class="share-white" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"/></g></svg>
</button>
<button class="delete" data-toggle="modal" data-target="#deleteFolder">
<svg xmlns="http://www.w3.org/2000/svg" width="14.932" height="16.033" viewBox="0 0 14.932 16.033"><defs><style>.trash-white{fill:#fff;}</style></defs><g transform="translate(0 0)"><g transform="translate(0 0)"><g transform="translate(0 0)"><path class="trash-white" d="M63.331,124.769a1.305,1.305,0,0,0,1.351,1.168h5.771a1.328,1.328,0,0,0,1.374-1.191l.939-9.8H62.186Z" transform="translate(-60.01 -109.905)"/><path class="trash-white" d="M27.028,2.061h-4.26V1.328A1.283,1.283,0,0,0,21.533,0H18.577a1.282,1.282,0,0,0-1.306,1.259q0,.035,0,.07v.733h-4.26a.458.458,0,0,0,0,.916H27.028a.458.458,0,1,0,0-.916Zm-5.176-.733v.733H18.188V1.328a.366.366,0,0,1,.389-.412h2.886a.366.366,0,0,1,.391.34A.362.362,0,0,1,21.852,1.328Z" transform="translate(-12.554 0)"/></g></g></g></svg>
</button>
</div>
<p class="folder-wrapper__specification-sheet--wrapper-image-text">Go to product details</p>
</figcaption>
</figure>
</div>
</div>

<div class="folder-wrapper__specification-sheet--buttons-box">

<div class="folder-wrapper__specification-sheet--buttons-box-content">
<span class="folder-wrapper__specification-sheet--buttons-box-image">
<svg xmlns="http://www.w3.org/2000/svg" width="24.704" height="16.27" viewBox="0 0 24.704 16.27">
<g id="open-folder-black-and-white-variant" transform="translate(0 -87.578)">
<path id="Path_434" data-name="Path 434" d="M18.618,102.844a1.7,1.7,0,0,0,1.429-.84l4.57-8.648c.273-.526-.124-.84-.84-.84H19.163V90.451a1.3,1.3,0,0,0-1.293-1.293H6.573l-.838-2.2a.59.59,0,0,0-.551-.38H.6a.589.589,0,0,0-.59.593l.011,3.28L0,101.554a1.3,1.3,0,0,0,1.293,1.293m16.69-10.33H7.922a1.392,1.392,0,0,0-1.134.84l-4.109,8.311H1.293a.114.114,0,0,1-.114-.114v-13.8h3.6l.838,2.2a.59.59,0,0,0,.551.38h11.7a.114.114,0,0,1,.114.114v2.066Z" transform="translate(0 1)" fill="#fff"/>
</g>
</svg>
</span>

<button class="folder-wrapper__specification-sheet--button js-hide-specification-sheet-box-btn">
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 495.785 495.785" xml:space="preserve"><path id="XMLID_26_" d="M436.855,90.337L255.175,0.541c-1.62-0.801-3.533-0.707-5.084,0.249c-1.535,0.957-2.467,2.638-2.467,4.449  v36.834H56.017v453.713h105.924V147.996h85.684v36.833c0,1.812,0.932,3.492,2.467,4.449c1.551,0.956,3.464,1.052,5.084,0.249  l181.68-89.796c1.791-0.888,2.914-2.706,2.914-4.698C439.769,93.043,438.646,91.225,436.855,90.337z"/><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
../ Specification sheet
</button>
</div>

<button class="folder-wrapper__specification-sheet--button second-fixed-button js-to-top">
Top
</button>

<button class="folder-wrapper__specification-sheet--button second-button js-hide-specification-sheet-box-btn">
Back
</button>
</div>
</div>
</div>

<div class="col-12 js-add-to-rooms-new-idea-folder-images" style="display: none;">
<div class="new-idea-folder-images__wrapper">
<div class="new-idea-folder-images__buttons">
<div class="new-idea-folder-images__buttons-box-content">
<span class="new-idea-folder-images__buttons-box-image">
<svg xmlns="http://www.w3.org/2000/svg" width="24.704" height="16.27" viewBox="0 0 24.704 16.27">
<g id="open-folder-black-and-white-variant" transform="translate(0 -87.578)">
<path id="Path_434" data-name="Path 434" d="M18.618,102.844a1.7,1.7,0,0,0,1.429-.84l4.57-8.648c.273-.526-.124-.84-.84-.84H19.163V90.451a1.3,1.3,0,0,0-1.293-1.293H6.573l-.838-2.2a.59.59,0,0,0-.551-.38H.6a.589.589,0,0,0-.59.593l.011,3.28L0,101.554a1.3,1.3,0,0,0,1.293,1.293m16.69-10.33H7.922a1.392,1.392,0,0,0-1.134.84l-4.109,8.311H1.293a.114.114,0,0,1-.114-.114v-13.8h3.6l.838,2.2a.59.59,0,0,0,.551.38h11.7a.114.114,0,0,1,.114.114v2.066Z" transform="translate(0 1)" fill="#fff"></path>
</g>
</svg>
</span>

<button class="new-idea-folder-images__button first-button js-hide-add-to-rooms-new-idea-folder-images-btn">
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 495.785 495.785" xml:space="preserve"><path id="XMLID_26_" d="M436.855,90.337L255.175,0.541c-1.62-0.801-3.533-0.707-5.084,0.249c-1.535,0.957-2.467,2.638-2.467,4.449  v36.834H56.017v453.713h105.924V147.996h85.684v36.833c0,1.812,0.932,3.492,2.467,4.449c1.551,0.956,3.464,1.052,5.084,0.249  l181.68-89.796c1.791-0.888,2.914-2.706,2.914-4.698C439.769,93.043,438.646,91.225,436.855,90.337z"></path><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
../ Nice things for glob...
</button>
</div>

<button class="new-idea-folder-images__button back-btn js-hide-add-to-rooms-new-idea-folder-images-btn">
Back
</button>
</div>

<div class="folder-wrapper__saved-elements">
<figure class="folder-wrapper__saved-element add-new-button js-url-modal-btn" 
data-tab-parrent="#v-pills-global" data-button-positon="folder-name" data-toggle="modal" data-target="#newImageUrl">
<figcaption class="add-new-button__wrap">

<span class="svg-group">
<span class="svg-group__first">
<svg xmlns="http://www.w3.org/2000/svg" width="34.215" height="51.323" viewBox="0 0 34.215 51.323">
<path id="Path_451" data-name="Path 451" d="M161.684,17.839,146.714.731a2.134,2.134,0,0,0-3.216,0L128.529,17.839a2.137,2.137,0,0,0,1.608,3.546h8.554v27.8a2.139,2.139,0,0,0,2.138,2.138h8.554a2.139,2.139,0,0,0,2.138-2.138v-27.8h8.554a2.137,2.137,0,0,0,1.608-3.546Z" transform="translate(-127.998)" fill="#fff"/>
</svg>
</span>
<span class="svg-group__second">
<svg xmlns="http://www.w3.org/2000/svg" width="21.992" height="9.797" viewBox="0 0 21.992 9.797">
<path id="Path_448" data-name="Path 448" d="M20.286,207.506a1.764,1.764,0,0,0-1.764,1.764v4.5H3.586v-4.5a1.764,1.764,0,0,0-3.528,0v6.269A1.764,1.764,0,0,0,1.822,217.3H20.286a1.764,1.764,0,0,0,1.764-1.764V209.27A1.764,1.764,0,0,0,20.286,207.506Z" transform="translate(-0.058 -207.506)" fill="#fff"/>
</svg>
</span>
</span>

<p class="folder-wrapper__saved-element--folders-text">Add an external URL of image or upload an image from the device</p>
</figcaption>
</figure>
<figure class="folder-wrapper__saved-element">
<img src="<?php echo SITEROOT; ?>images/idea-folder-room-2.png" alt="" class="folder-wrapper__saved-element--img img-fluid">
<figcaption class="folder-wrapper__saved-element--text-box">
<div class="folder-wrapper__saved-element--buttons">
<button class="shere">
<svg xmlns="http://www.w3.org/2000/svg" width="23.547" height="25.688" viewBox="0 0 23.547 25.688"><defs><style>.share-white{fill:#fff;}</style></defs><g transform="translate(0)"><path class="share-white" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"/><path class="share-white" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"/><path class="share-white" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"/><path class="share-white" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"/><path class="share-white" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"/><path class="share-white" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"/><path class="share-white" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"/><path class="share-white" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"/></g></svg>
</button>
<button class="delete" data-toggle="modal" data-target="#deleteFolder">
<svg xmlns="http://www.w3.org/2000/svg" width="14.932" height="16.033" viewBox="0 0 14.932 16.033"><defs><style>.trash-white{fill:#fff;}</style></defs><g transform="translate(0 0)"><g transform="translate(0 0)"><g transform="translate(0 0)"><path class="trash-white" d="M63.331,124.769a1.305,1.305,0,0,0,1.351,1.168h5.771a1.328,1.328,0,0,0,1.374-1.191l.939-9.8H62.186Z" transform="translate(-60.01 -109.905)"/><path class="trash-white" d="M27.028,2.061h-4.26V1.328A1.283,1.283,0,0,0,21.533,0H18.577a1.282,1.282,0,0,0-1.306,1.259q0,.035,0,.07v.733h-4.26a.458.458,0,0,0,0,.916H27.028a.458.458,0,1,0,0-.916Zm-5.176-.733v.733H18.188V1.328a.366.366,0,0,1,.389-.412h2.886a.366.366,0,0,1,.391.34A.362.362,0,0,1,21.852,1.328Z" transform="translate(-12.554 0)"/></g></g></g></svg>
</button>
</div>
<div class="idea-folder-gallery">
<a href="images/idea-folder-room-2.png" title="Lorem ipsum" class="folder-wrapper__saved-element--text">
Preview
</a>
</div>
</figcaption>
</figure>
<figure class="folder-wrapper__saved-element">
<img src="<?php echo SITEROOT; ?>images/idea-folder-room-3.png" alt="" class="folder-wrapper__saved-element--img img-fluid">
<figcaption class="folder-wrapper__saved-element--text-box">
<div class="folder-wrapper__saved-element--buttons">
<button class="shere">
<svg xmlns="http://www.w3.org/2000/svg" width="23.547" height="25.688" viewBox="0 0 23.547 25.688"><defs><style>.share-white{fill:#fff;}</style></defs><g transform="translate(0)"><path class="share-white" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"/><path class="share-white" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"/><path class="share-white" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"/><path class="share-white" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"/><path class="share-white" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"/><path class="share-white" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"/><path class="share-white" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"/><path class="share-white" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"/></g></svg>
</button>
<button class="delete" data-toggle="modal" data-target="#deleteFolder">
<svg xmlns="http://www.w3.org/2000/svg" width="14.932" height="16.033" viewBox="0 0 14.932 16.033"><defs><style>.trash-white{fill:#fff;}</style></defs><g transform="translate(0 0)"><g transform="translate(0 0)"><g transform="translate(0 0)"><path class="trash-white" d="M63.331,124.769a1.305,1.305,0,0,0,1.351,1.168h5.771a1.328,1.328,0,0,0,1.374-1.191l.939-9.8H62.186Z" transform="translate(-60.01 -109.905)"/><path class="trash-white" d="M27.028,2.061h-4.26V1.328A1.283,1.283,0,0,0,21.533,0H18.577a1.282,1.282,0,0,0-1.306,1.259q0,.035,0,.07v.733h-4.26a.458.458,0,0,0,0,.916H27.028a.458.458,0,1,0,0-.916Zm-5.176-.733v.733H18.188V1.328a.366.366,0,0,1,.389-.412h2.886a.366.366,0,0,1,.391.34A.362.362,0,0,1,21.852,1.328Z" transform="translate(-12.554 0)"/></g></g></g></svg>
</button>
</div>
<div class="idea-folder-gallery">
<a href="images/idea-folder-room-3.png" title="Lorem ipsum" class="folder-wrapper__saved-element--text">
Preview
</a>
</div>
</figcaption>
</figure>
<figure class="folder-wrapper__saved-element">
<img src="<?php echo SITEROOT; ?>images/idea-folder-room-4.png" alt="" class="folder-wrapper__saved-element--img img-fluid">
<figcaption class="folder-wrapper__saved-element--text-box">
<div class="folder-wrapper__saved-element--buttons">
<button class="shere">
<svg xmlns="http://www.w3.org/2000/svg" width="23.547" height="25.688" viewBox="0 0 23.547 25.688"><defs><style>.share-white{fill:#fff;}</style></defs><g transform="translate(0)"><path class="share-white" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"/><path class="share-white" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"/><path class="share-white" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"/><path class="share-white" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"/><path class="share-white" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"/><path class="share-white" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"/><path class="share-white" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"/><path class="share-white" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"/></g></svg>
</button>
<button class="delete" data-toggle="modal" data-target="#deleteFolder">
<svg xmlns="http://www.w3.org/2000/svg" width="14.932" height="16.033" viewBox="0 0 14.932 16.033"><defs><style>.trash-white{fill:#fff;}</style></defs><g transform="translate(0 0)"><g transform="translate(0 0)"><g transform="translate(0 0)"><path class="trash-white" d="M63.331,124.769a1.305,1.305,0,0,0,1.351,1.168h5.771a1.328,1.328,0,0,0,1.374-1.191l.939-9.8H62.186Z" transform="translate(-60.01 -109.905)"/><path class="trash-white" d="M27.028,2.061h-4.26V1.328A1.283,1.283,0,0,0,21.533,0H18.577a1.282,1.282,0,0,0-1.306,1.259q0,.035,0,.07v.733h-4.26a.458.458,0,0,0,0,.916H27.028a.458.458,0,1,0,0-.916Zm-5.176-.733v.733H18.188V1.328a.366.366,0,0,1,.389-.412h2.886a.366.366,0,0,1,.391.34A.362.362,0,0,1,21.852,1.328Z" transform="translate(-12.554 0)"/></g></g></g></svg>
</button>
</div>
<div class="idea-folder-gallery">
<a href="images/idea-folder-room-4.png" title="Lorem ipsum" class="folder-wrapper__saved-element--text">
Preview
</a>
</div>
</figcaption>
</figure>
<figure class="folder-wrapper__saved-element">
<img src="<?php echo SITEROOT; ?>images/idea-folder-room-5.png" alt="" class="folder-wrapper__saved-element--img img-fluid">
<figcaption class="folder-wrapper__saved-element--text-box">
<div class="folder-wrapper__saved-element--buttons">
<button class="shere">
<svg xmlns="http://www.w3.org/2000/svg" width="23.547" height="25.688" viewBox="0 0 23.547 25.688"><defs><style>.share-white{fill:#fff;}</style></defs><g transform="translate(0)"><path class="share-white" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"/><path class="share-white" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"/><path class="share-white" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"/><path class="share-white" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"/><path class="share-white" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"/><path class="share-white" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"/><path class="share-white" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"/><path class="share-white" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"/></g></svg>
</button>
<button class="delete" data-toggle="modal" data-target="#deleteFolder">
<svg xmlns="http://www.w3.org/2000/svg" width="14.932" height="16.033" viewBox="0 0 14.932 16.033"><defs><style>.trash-white{fill:#fff;}</style></defs><g transform="translate(0 0)"><g transform="translate(0 0)"><g transform="translate(0 0)"><path class="trash-white" d="M63.331,124.769a1.305,1.305,0,0,0,1.351,1.168h5.771a1.328,1.328,0,0,0,1.374-1.191l.939-9.8H62.186Z" transform="translate(-60.01 -109.905)"/><path class="trash-white" d="M27.028,2.061h-4.26V1.328A1.283,1.283,0,0,0,21.533,0H18.577a1.282,1.282,0,0,0-1.306,1.259q0,.035,0,.07v.733h-4.26a.458.458,0,0,0,0,.916H27.028a.458.458,0,1,0,0-.916Zm-5.176-.733v.733H18.188V1.328a.366.366,0,0,1,.389-.412h2.886a.366.366,0,0,1,.391.34A.362.362,0,0,1,21.852,1.328Z" transform="translate(-12.554 0)"/></g></g></g></svg>
</button>
</div>
<div class="idea-folder-gallery">
<a href="images/idea-folder-room-5.png" title="Lorem ipsum" class="folder-wrapper__saved-element--text">
Preview
</a>
</div>
</figcaption>
</figure>
</div>
</div>
</div>
</div>
</div>
</div>


<div class="tab-pane fade" id="v-pills-living-room" role="tabpanel" aria-labelledby="v-pills-living-room-tab">
<div class="folder-wrapper">
<div class="desktop-show">
<div class="row mb-2">
<div class="col-8">
<h3 class="folder-wrapper__heading">Title house name 1 - Living Room</h3>
</div>
<div class="col-4">
<p class="folder-wrapper__all-items">
<span class="folder-wrapper__all-items--img">5</span> images / 
<span class="folder-wrapper__all-items--subfolders">1</span> subfolder
</p>
</div>
</div>
<div class="row mb-4">
<div class="col-6 d-flex align-items-center">
<button class="folder-wrapper__specification-sheet-top-btn js-show-specification-sheet-btn">
<span></span>
Specification sheet
</button>
<button class="folder-wrapper__info" data-toggle="modal" data-target="#specificationsSheetInfo">
<svg xmlns="http://www.w3.org/2000/svg" width="17.667" height="17.667" viewBox="0 0 17.667 17.667">
<g id="Info2Btn" transform="translate(-343 -723)">
<path id="Path_184" data-name="Path 184" d="M8.833,0a8.833,8.833,0,1,0,8.833,8.833A8.843,8.843,0,0,0,8.833,0Zm0,16.061a7.227,7.227,0,1,1,7.227-7.227A7.235,7.235,0,0,1,8.833,16.061Z" transform="translate(343 723)"/>
<path id="Path_185" data-name="Path 185" d="M146.072,70a1.071,1.071,0,1,0,1.07,1.071A1.072,1.072,0,0,0,146.072,70Z" transform="translate(205.761 656.747)"/>
<path id="Path_186" data-name="Path 186" d="M150.8,140a.8.8,0,0,0-.8.8v4.818a.8.8,0,0,0,1.606,0V140.8A.8.8,0,0,0,150.8,140Z" transform="translate(201.03 590.495)"/>
</g>
</svg>
</button>
</div>
<div class="col-6 text-right">
<div class="folder-wrapper__filters">
<div class="my-custom-select-wrapper">
<div class="my-custom-select">
<div class="my-custom-select__trigger"><span>Reorder by</span>
<div class="arrow"></div>
</div>
<div class="my-custom-options">
<span class="my-custom-option selected" data-value="Reorder by">Reorder by</span>
<span class="my-custom-option" data-value="Name">Name</span>
<span class="my-custom-option" data-value="Lastest">Lastest</span>
<span class="my-custom-option" data-value="Older">Older</span>
<span class="my-custom-option" data-value="Number of rooms">Number of rooms</span>
<span class="my-custom-option" data-value="Most visited">Most visited</span>
</div>
</div>
</div>

<div class="folder-wrapper__buttons">
<button class="shere">
<svg id="share" xmlns="http://www.w3.org/2000/svg" width="42.5" height="42.5" viewBox="0 0 42.5 42.5">
<path id="Path_226" data-name="Path 226" d="M2.5,0A2.5,2.5,0,1,1,0,2.5,2.5,2.5,0,0,1,2.5,0Z" transform="translate(10 19)" fill="#384765"></path>
<path id="Path_225" data-name="Path 225" d="M2.5,0A2.5,2.5,0,1,1,0,2.5,2.5,2.5,0,0,1,2.5,0Z" transform="translate(25 26)" fill="#384765"></path>
<path id="Path_224" data-name="Path 224" d="M2.5,0A2.5,2.5,0,1,1,0,2.5,2.5,2.5,0,0,1,2.5,0Z" transform="translate(25 11)" fill="#384765"></path>
<path id="Path_209" data-name="Path 209" d="M21.25,0A21.25,21.25,0,1,0,42.5,21.25,21.333,21.333,0,0,0,21.25,0ZM17.484,21.556l6.348,3.794a5.112,5.112,0,1,1-1.181,2.195l-5.96-3.562a5,5,0,1,1-.3-5.842l6.193-3.46a5.046,5.046,0,1,1,1.069,2.255L17.43,20.413a2.916,2.916,0,0,1,.054,1.143Z" fill="#384765"></path>
</svg>
</button>
<button class="delete" data-toggle="modal" data-target="#deleteFolder">
<svg xmlns="http://www.w3.org/2000/svg" width="43" height="43" viewBox="0 0 43 43">
<g id="trash" transform="translate(11.363 9.917)">
<circle id="Ellipse_36" data-name="Ellipse 36" cx="21.5" cy="21.5" r="21.5" transform="translate(-11.363 -9.917)" fill="#fb561b"></circle>
<path id="Path_408" data-name="Path 408" d="M63.808,128.863a1.849,1.849,0,0,0,1.914,1.655H73.9a1.882,1.882,0,0,0,1.947-1.687l1.33-13.886H62.186Z" transform="translate(-59.104 -107.806)" fill="#fff"></path>
<path id="Path_409" data-name="Path 409" d="M33.059,2.92H27.024V1.882A1.817,1.817,0,0,0,25.274,0H21.087a1.817,1.817,0,0,0-1.85,1.783q0,.049,0,.1V2.92H13.2a.649.649,0,0,0,0,1.3H33.059a.649.649,0,1,0,0-1.3ZM25.726,1.882V2.92H20.535V1.882a.519.519,0,0,1,.552-.584h4.088a.519.519,0,0,1,.554.481A.513.513,0,0,1,25.726,1.882Z" transform="translate(-12.554 0)" fill="#fff"></path>
</g>
</svg>
</button>
</div>
</div>
</div>
</div>
</div>
<div class="row">
<div class="col-12 js-saved-images-box">
<div class="folder-wrapper__saved-elements">
<figure class="folder-wrapper__saved-element specification-sheet">
<figcaption class="folder-wrapper__saved-element--folders">
<span class="folder-wrapper__saved-element--folders-img">
<svg xmlns="http://www.w3.org/2000/svg" width="24.704" height="16.27" viewBox="0 0 24.704 16.27">
<g id="open-folder-black-and-white-variant" transform="translate(0 -87.578)">
<path id="Path_434" data-name="Path 434" d="M18.618,102.844a1.7,1.7,0,0,0,1.429-.84l4.57-8.648c.273-.526-.124-.84-.84-.84H19.163V90.451a1.3,1.3,0,0,0-1.293-1.293H6.573l-.838-2.2a.59.59,0,0,0-.551-.38H.6a.589.589,0,0,0-.59.593l.011,3.28L0,101.554a1.3,1.3,0,0,0,1.293,1.293m16.69-10.33H7.922a1.392,1.392,0,0,0-1.134.84l-4.109,8.311H1.293a.114.114,0,0,1-.114-.114v-13.8h3.6l.838,2.2a.59.59,0,0,0,.551.38h11.7a.114.114,0,0,1,.114.114v2.066Z" transform="translate(0 1)" fill="#fff"/>
</g>
</svg>
</span>
<div class="folder-wrapper__saved-element--buttons">
<button class="shere">
<svg xmlns="http://www.w3.org/2000/svg" width="23.547" height="25.688" viewBox="0 0 23.547 25.688"><defs><style>.share-white{fill:#fff;}</style></defs><g transform="translate(0)"><path class="share-white" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"/><path class="share-white" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"/><path class="share-white" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"/><path class="share-white" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"/><path class="share-white" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"/><path class="share-white" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"/><path class="share-white" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"/><path class="share-white" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"/></g></svg>
</button>
<button class="delete" data-toggle="modal" data-target="#deleteFolder">
<svg xmlns="http://www.w3.org/2000/svg" width="14.932" height="16.033" viewBox="0 0 14.932 16.033"><defs><style>.trash-white{fill:#fff;}</style></defs><g transform="translate(0 0)"><g transform="translate(0 0)"><g transform="translate(0 0)"><path class="trash-white" d="M63.331,124.769a1.305,1.305,0,0,0,1.351,1.168h5.771a1.328,1.328,0,0,0,1.374-1.191l.939-9.8H62.186Z" transform="translate(-60.01 -109.905)"/><path class="trash-white" d="M27.028,2.061h-4.26V1.328A1.283,1.283,0,0,0,21.533,0H18.577a1.282,1.282,0,0,0-1.306,1.259q0,.035,0,.07v.733h-4.26a.458.458,0,0,0,0,.916H27.028a.458.458,0,1,0,0-.916Zm-5.176-.733v.733H18.188V1.328a.366.366,0,0,1,.389-.412h2.886a.366.366,0,0,1,.391.34A.362.362,0,0,1,21.852,1.328Z" transform="translate(-12.554 0)"/></g></g></g></svg>
</button>
</div>
<p class="folder-wrapper__saved-element--text first">Specification sheet</p>
<button class="folder-wrapper__saved-element--folders-button"><span onClick="open_specs();">open folder</span></button>
</figcaption>
</figure>
<figure class="folder-wrapper__saved-element add-new-button js-url-modal-btn" data-tab-parrent="#v-pills-living-room" data-button-positon="room-name" data-toggle="modal" data-target="#newImageUrl">
<figcaption class="add-new-button__wrap">

<span class="svg-group">
<span class="svg-group__first">
<svg xmlns="http://www.w3.org/2000/svg" width="34.215" height="51.323" viewBox="0 0 34.215 51.323">
<path id="Path_451" data-name="Path 451" d="M161.684,17.839,146.714.731a2.134,2.134,0,0,0-3.216,0L128.529,17.839a2.137,2.137,0,0,0,1.608,3.546h8.554v27.8a2.139,2.139,0,0,0,2.138,2.138h8.554a2.139,2.139,0,0,0,2.138-2.138v-27.8h8.554a2.137,2.137,0,0,0,1.608-3.546Z" transform="translate(-127.998)" fill="#fff"/>
</svg>
</span>
<span class="svg-group__second">
<svg xmlns="http://www.w3.org/2000/svg" width="21.992" height="9.797" viewBox="0 0 21.992 9.797">
<path id="Path_448" data-name="Path 448" d="M20.286,207.506a1.764,1.764,0,0,0-1.764,1.764v4.5H3.586v-4.5a1.764,1.764,0,0,0-3.528,0v6.269A1.764,1.764,0,0,0,1.822,217.3H20.286a1.764,1.764,0,0,0,1.764-1.764V209.27A1.764,1.764,0,0,0,20.286,207.506Z" transform="translate(-0.058 -207.506)" fill="#fff"/>
</svg>
</span>
</span>

<p class="folder-wrapper__saved-element--folders-text">Add an external URL of image or upload an image from the device</p>
</figcaption>
</figure>
<figure class="folder-wrapper__saved-element">
<img src="<?php echo SITEROOT; ?>images/idea-folder-room-3.png" alt="" class="folder-wrapper__saved-element--img img-fluid">
<figcaption class="folder-wrapper__saved-element--text-box">
<a href="#" title="" class="folder-wrapper__saved-element--link"></a>
<div class="folder-wrapper__saved-element--buttons">
<button class="shere">
<svg xmlns="http://www.w3.org/2000/svg" width="23.547" height="25.688" viewBox="0 0 23.547 25.688"><defs><style>.share-white{fill:#fff;}</style></defs><g transform="translate(0)"><path class="share-white" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"/><path class="share-white" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"/><path class="share-white" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"/><path class="share-white" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"/><path class="share-white" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"/><path class="share-white" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"/><path class="share-white" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"/><path class="share-white" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"/></g></svg>
</button>
<button class="delete" data-toggle="modal" data-target="#deleteFolder">
<svg xmlns="http://www.w3.org/2000/svg" width="14.932" height="16.033" viewBox="0 0 14.932 16.033"><defs><style>.trash-white{fill:#fff;}</style></defs><g transform="translate(0 0)"><g transform="translate(0 0)"><g transform="translate(0 0)"><path class="trash-white" d="M63.331,124.769a1.305,1.305,0,0,0,1.351,1.168h5.771a1.328,1.328,0,0,0,1.374-1.191l.939-9.8H62.186Z" transform="translate(-60.01 -109.905)"/><path class="trash-white" d="M27.028,2.061h-4.26V1.328A1.283,1.283,0,0,0,21.533,0H18.577a1.282,1.282,0,0,0-1.306,1.259q0,.035,0,.07v.733h-4.26a.458.458,0,0,0,0,.916H27.028a.458.458,0,1,0,0-.916Zm-5.176-.733v.733H18.188V1.328a.366.366,0,0,1,.389-.412h2.886a.366.366,0,0,1,.391.34A.362.362,0,0,1,21.852,1.328Z" transform="translate(-12.554 0)"/></g></g></g></svg>
</button>
</div>
<p class="folder-wrapper__saved-element--text">Go to product details</p>
</figcaption>
</figure>
<figure class="folder-wrapper__saved-element">
<img src="<?php echo SITEROOT; ?>images/idea-folder-room-4.png" alt="" class="folder-wrapper__saved-element--img img-fluid">
<figcaption class="folder-wrapper__saved-element--text-box">
<a href="#" title="" class="folder-wrapper__saved-element--link"></a>
<div class="folder-wrapper__saved-element--buttons">
<button class="shere">
<svg xmlns="http://www.w3.org/2000/svg" width="23.547" height="25.688" viewBox="0 0 23.547 25.688"><defs><style>.share-white{fill:#fff;}</style></defs><g transform="translate(0)"><path class="share-white" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"/><path class="share-white" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"/><path class="share-white" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"/><path class="share-white" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"/><path class="share-white" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"/><path class="share-white" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"/><path class="share-white" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"/><path class="share-white" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"/></g></svg>
</button>
<button class="delete" data-toggle="modal" data-target="#deleteFolder">
<svg xmlns="http://www.w3.org/2000/svg" width="14.932" height="16.033" viewBox="0 0 14.932 16.033"><defs><style>.trash-white{fill:#fff;}</style></defs><g transform="translate(0 0)"><g transform="translate(0 0)"><g transform="translate(0 0)"><path class="trash-white" d="M63.331,124.769a1.305,1.305,0,0,0,1.351,1.168h5.771a1.328,1.328,0,0,0,1.374-1.191l.939-9.8H62.186Z" transform="translate(-60.01 -109.905)"/><path class="trash-white" d="M27.028,2.061h-4.26V1.328A1.283,1.283,0,0,0,21.533,0H18.577a1.282,1.282,0,0,0-1.306,1.259q0,.035,0,.07v.733h-4.26a.458.458,0,0,0,0,.916H27.028a.458.458,0,1,0,0-.916Zm-5.176-.733v.733H18.188V1.328a.366.366,0,0,1,.389-.412h2.886a.366.366,0,0,1,.391.34A.362.362,0,0,1,21.852,1.328Z" transform="translate(-12.554 0)"/></g></g></g></svg>
</button>
</div>
<p class="folder-wrapper__saved-element--text">Go to product details</p>
</figcaption>
</figure>
<figure class="folder-wrapper__saved-element">
<img src="<?php echo SITEROOT; ?>images/idea-folder-room-5.png" alt="" class="folder-wrapper__saved-element--img img-fluid">
<figcaption class="folder-wrapper__saved-element--text-box">
<a href="#" title="" class="folder-wrapper__saved-element--link"></a>
<div class="folder-wrapper__saved-element--buttons">
<button class="shere">
<svg xmlns="http://www.w3.org/2000/svg" width="23.547" height="25.688" viewBox="0 0 23.547 25.688"><defs><style>.share-white{fill:#fff;}</style></defs><g transform="translate(0)"><path class="share-white" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"/><path class="share-white" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"/><path class="share-white" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"/><path class="share-white" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"/><path class="share-white" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"/><path class="share-white" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"/><path class="share-white" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"/><path class="share-white" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"/></g></svg>
</button>
<button class="delete" data-toggle="modal" data-target="#deleteFolder">
<svg xmlns="http://www.w3.org/2000/svg" width="14.932" height="16.033" viewBox="0 0 14.932 16.033"><defs><style>.trash-white{fill:#fff;}</style></defs><g transform="translate(0 0)"><g transform="translate(0 0)"><g transform="translate(0 0)"><path class="trash-white" d="M63.331,124.769a1.305,1.305,0,0,0,1.351,1.168h5.771a1.328,1.328,0,0,0,1.374-1.191l.939-9.8H62.186Z" transform="translate(-60.01 -109.905)"/><path class="trash-white" d="M27.028,2.061h-4.26V1.328A1.283,1.283,0,0,0,21.533,0H18.577a1.282,1.282,0,0,0-1.306,1.259q0,.035,0,.07v.733h-4.26a.458.458,0,0,0,0,.916H27.028a.458.458,0,1,0,0-.916Zm-5.176-.733v.733H18.188V1.328a.366.366,0,0,1,.389-.412h2.886a.366.366,0,0,1,.391.34A.362.362,0,0,1,21.852,1.328Z" transform="translate(-12.554 0)"/></g></g></g></svg>
</button>
</div>
<p class="folder-wrapper__saved-element--text">Go to product details</p>
</figcaption>
</figure>
<figure class="folder-wrapper__saved-element folders">
<figcaption class="folder-wrapper__saved-element--folders">
<span class="folder-wrapper__saved-element--folders-img">
<svg xmlns="http://www.w3.org/2000/svg" width="86" height="71.044" viewBox="0 0 86 71.044"><defs><style>.folder-orange{fill:#edb700;}</style></defs><g transform="translate(-10.667)"><g transform="translate(10.667 7.478)"><g transform="translate(0)"><path class="folder-orange" d="M87.319,53.884H44.1a5.6,5.6,0,0,1-5.321-3.836l-.329-.991a9.337,9.337,0,0,0-8.865-6.39H20.015a9.361,9.361,0,0,0-9.348,9.348v44.87a9.358,9.358,0,0,0,9.348,9.348H34.971a1.87,1.87,0,1,0,0-3.739H20.015a5.615,5.615,0,0,1-5.609-5.609V52.015a5.615,5.615,0,0,1,5.609-5.609h9.568A5.6,5.6,0,0,1,34.9,50.239l.333.995a9.337,9.337,0,0,0,8.865,6.39H87.319a5.615,5.615,0,0,1,5.609,5.609V96.884a5.615,5.615,0,0,1-5.609,5.609H72.363a1.87,1.87,0,0,0,0,3.739H87.319a9.356,9.356,0,0,0,9.348-9.348V63.232A9.358,9.358,0,0,0,87.319,53.884Z" transform="translate(-10.667 -42.667)"/></g></g><g transform="translate(14.406)"><path class="folder-orange" d="M101.174,0H41.348A9.361,9.361,0,0,0,32,9.348a1.87,1.87,0,0,0,3.739,0,5.615,5.615,0,0,1,5.609-5.609h59.826a5.615,5.615,0,0,1,5.609,5.609V20.565a1.87,1.87,0,1,0,3.739,0V9.348A9.359,9.359,0,0,0,101.174,0Z" transform="translate(-32)"/></g></g></svg>
</span>
<p class="folder-wrapper__saved-element--folders-text">Nice things for living room</p>
<button class="folder-wrapper__saved-element--folders-button js-show-add-to-rooms-new-idea-folder-images-btn">View folder</button>
</figcaption>
</figure>
<figure class="folder-wrapper__saved-element">
<img src="<?php echo SITEROOT; ?>images/idea-folder-room-2.png" alt="" class="folder-wrapper__saved-element--img img-fluid">
<figcaption class="folder-wrapper__saved-element--text-box">
<a href="#" title="" class="folder-wrapper__saved-element--link"></a>
<div class="folder-wrapper__saved-element--buttons">
<button class="shere">
<svg xmlns="http://www.w3.org/2000/svg" width="23.547" height="25.688" viewBox="0 0 23.547 25.688"><defs><style>.share-white{fill:#fff;}</style></defs><g transform="translate(0)"><path class="share-white" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"/><path class="share-white" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"/><path class="share-white" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"/><path class="share-white" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"/><path class="share-white" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"/><path class="share-white" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"/><path class="share-white" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"/><path class="share-white" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"/></g></svg>
</button>
<button class="delete" data-toggle="modal" data-target="#deleteFolder">
<svg xmlns="http://www.w3.org/2000/svg" width="14.932" height="16.033" viewBox="0 0 14.932 16.033"><defs><style>.trash-white{fill:#fff;}</style></defs><g transform="translate(0 0)"><g transform="translate(0 0)"><g transform="translate(0 0)"><path class="trash-white" d="M63.331,124.769a1.305,1.305,0,0,0,1.351,1.168h5.771a1.328,1.328,0,0,0,1.374-1.191l.939-9.8H62.186Z" transform="translate(-60.01 -109.905)"/><path class="trash-white" d="M27.028,2.061h-4.26V1.328A1.283,1.283,0,0,0,21.533,0H18.577a1.282,1.282,0,0,0-1.306,1.259q0,.035,0,.07v.733h-4.26a.458.458,0,0,0,0,.916H27.028a.458.458,0,1,0,0-.916Zm-5.176-.733v.733H18.188V1.328a.366.366,0,0,1,.389-.412h2.886a.366.366,0,0,1,.391.34A.362.362,0,0,1,21.852,1.328Z" transform="translate(-12.554 0)"/></g></g></g></svg>
</button>
</div>
<p class="folder-wrapper__saved-element--text">Go to product details</p>
</figcaption>
</figure>
</div>
</div>

<div class="col-12 js-specification-sheet-box" style="display: none;">
<div class="folder-wrapper__specification-sheet--wrapper">

<div class="folder-wrapper__specification-sheet--buttons-box">

<div class="folder-wrapper__specification-sheet--buttons-box-content">
<span class="folder-wrapper__specification-sheet--buttons-box-image">
<svg xmlns="http://www.w3.org/2000/svg" width="24.704" height="16.27" viewBox="0 0 24.704 16.27">
<g id="open-folder-black-and-white-variant" transform="translate(0 -87.578)">
<path id="Path_434" data-name="Path 434" d="M18.618,102.844a1.7,1.7,0,0,0,1.429-.84l4.57-8.648c.273-.526-.124-.84-.84-.84H19.163V90.451a1.3,1.3,0,0,0-1.293-1.293H6.573l-.838-2.2a.59.59,0,0,0-.551-.38H.6a.589.589,0,0,0-.59.593l.011,3.28L0,101.554a1.3,1.3,0,0,0,1.293,1.293m16.69-10.33H7.922a1.392,1.392,0,0,0-1.134.84l-4.109,8.311H1.293a.114.114,0,0,1-.114-.114v-13.8h3.6l.838,2.2a.59.59,0,0,0,.551.38h11.7a.114.114,0,0,1,.114.114v2.066Z" transform="translate(0 1)" fill="#fff"/>
</g>
</svg>
</span>

<button class="folder-wrapper__specification-sheet--button js-hide-specification-sheet-box-btn">
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 495.785 495.785" xml:space="preserve"><path id="XMLID_26_" d="M436.855,90.337L255.175,0.541c-1.62-0.801-3.533-0.707-5.084,0.249c-1.535,0.957-2.467,2.638-2.467,4.449  v36.834H56.017v453.713h105.924V147.996h85.684v36.833c0,1.812,0.932,3.492,2.467,4.449c1.551,0.956,3.464,1.052,5.084,0.249  l181.68-89.796c1.791-0.888,2.914-2.706,2.914-4.698C439.769,93.043,438.646,91.225,436.855,90.337z"/><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
../ Specification sheet
</button>
</div>

<div class="d-flex justify-content-center align-items-center">
<div class="house-checkbox">
<input class="custom-checkbox js-load-confirm-modal" id="checkbox-3" type="checkbox" value="value3" data-target="#confirmModal">
<label for="checkbox-3">Share with Closets To Go</label>
</div>

<button class="folder-wrapper__specification-sheet--button second-button js-hide-specification-sheet-box-btn">
Back
</button>
</div>
</div>

<div class="folder-wrapper__specification-sheet--wrapper-content">
<h3 class="folder-wrapper__specification-sheet--wrapper-heading">Accessory</h3>

<div class="folder-wrapper__specification-sheet--wrapper-image-wrap">
<figure class="folder-wrapper__specification-sheet--wrapper-image-box">
<img src="<?php echo SITEROOT; ?>images/idea-folder-room-5.png" alt="" class="folder-wrapper__specification-sheet--wrapper-image-img img-fluid">

<figcaption class="folder-wrapper__specification-sheet--wrapper-image-content">
<div class="folder-wrapper__specification-sheet--wrapper-image-buttons">
<button class="shere">
<svg xmlns="http://www.w3.org/2000/svg" width="23.547" height="25.688" viewBox="0 0 23.547 25.688"><defs><style>.share-white{fill:#fff;}</style></defs><g transform="translate(0)"><path class="share-white" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"/><path class="share-white" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"/><path class="share-white" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"/><path class="share-white" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"/><path class="share-white" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"/><path class="share-white" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"/><path class="share-white" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"/><path class="share-white" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"/></g></svg>
</button>
<button class="delete" data-toggle="modal" data-target="#deleteFolder">
<svg xmlns="http://www.w3.org/2000/svg" width="14.932" height="16.033" viewBox="0 0 14.932 16.033"><defs><style>.trash-white{fill:#fff;}</style></defs><g transform="translate(0 0)"><g transform="translate(0 0)"><g transform="translate(0 0)"><path class="trash-white" d="M63.331,124.769a1.305,1.305,0,0,0,1.351,1.168h5.771a1.328,1.328,0,0,0,1.374-1.191l.939-9.8H62.186Z" transform="translate(-60.01 -109.905)"/><path class="trash-white" d="M27.028,2.061h-4.26V1.328A1.283,1.283,0,0,0,21.533,0H18.577a1.282,1.282,0,0,0-1.306,1.259q0,.035,0,.07v.733h-4.26a.458.458,0,0,0,0,.916H27.028a.458.458,0,1,0,0-.916Zm-5.176-.733v.733H18.188V1.328a.366.366,0,0,1,.389-.412h2.886a.366.366,0,0,1,.391.34A.362.362,0,0,1,21.852,1.328Z" transform="translate(-12.554 0)"/></g></g></g></svg>
</button>
</div>
<p class="folder-wrapper__specification-sheet--wrapper-image-text">Go to product details</p>
</figcaption>
</figure>

<figure class="folder-wrapper__specification-sheet--wrapper-image-box">
<img src="<?php echo SITEROOT; ?>images/idea-folder-room-2.png" alt="" class="folder-wrapper__specification-sheet--wrapper-image-img img-fluid">

<figcaption class="folder-wrapper__specification-sheet--wrapper-image-content">
<div class="folder-wrapper__specification-sheet--wrapper-image-buttons">
<button class="shere">
<svg xmlns="http://www.w3.org/2000/svg" width="23.547" height="25.688" viewBox="0 0 23.547 25.688"><defs><style>.share-white{fill:#fff;}</style></defs><g transform="translate(0)"><path class="share-white" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"/><path class="share-white" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"/><path class="share-white" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"/><path class="share-white" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"/><path class="share-white" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"/><path class="share-white" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"/><path class="share-white" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"/><path class="share-white" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"/></g></svg>
</button>
<button class="delete" data-toggle="modal" data-target="#deleteFolder">
<svg xmlns="http://www.w3.org/2000/svg" width="14.932" height="16.033" viewBox="0 0 14.932 16.033"><defs><style>.trash-white{fill:#fff;}</style></defs><g transform="translate(0 0)"><g transform="translate(0 0)"><g transform="translate(0 0)"><path class="trash-white" d="M63.331,124.769a1.305,1.305,0,0,0,1.351,1.168h5.771a1.328,1.328,0,0,0,1.374-1.191l.939-9.8H62.186Z" transform="translate(-60.01 -109.905)"/><path class="trash-white" d="M27.028,2.061h-4.26V1.328A1.283,1.283,0,0,0,21.533,0H18.577a1.282,1.282,0,0,0-1.306,1.259q0,.035,0,.07v.733h-4.26a.458.458,0,0,0,0,.916H27.028a.458.458,0,1,0,0-.916Zm-5.176-.733v.733H18.188V1.328a.366.366,0,0,1,.389-.412h2.886a.366.366,0,0,1,.391.34A.362.362,0,0,1,21.852,1.328Z" transform="translate(-12.554 0)"/></g></g></g></svg>
</button>
</div>
<p class="folder-wrapper__specification-sheet--wrapper-image-text">Go to product details</p>
</figcaption>
</figure>

<figure class="folder-wrapper__specification-sheet--wrapper-image-box">
<img src="<?php echo SITEROOT; ?>images/idea-folder-room-3.png" alt="" class="folder-wrapper__specification-sheet--wrapper-image-img img-fluid">

<figcaption class="folder-wrapper__specification-sheet--wrapper-image-content">
<div class="folder-wrapper__specification-sheet--wrapper-image-buttons">
<button class="shere">
<svg xmlns="http://www.w3.org/2000/svg" width="23.547" height="25.688" viewBox="0 0 23.547 25.688"><defs><style>.share-white{fill:#fff;}</style></defs><g transform="translate(0)"><path class="share-white" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"/><path class="share-white" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"/><path class="share-white" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"/><path class="share-white" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"/><path class="share-white" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"/><path class="share-white" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"/><path class="share-white" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"/><path class="share-white" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"/></g></svg>
</button>
<button class="delete" data-toggle="modal" data-target="#deleteFolder">
<svg xmlns="http://www.w3.org/2000/svg" width="14.932" height="16.033" viewBox="0 0 14.932 16.033"><defs><style>.trash-white{fill:#fff;}</style></defs><g transform="translate(0 0)"><g transform="translate(0 0)"><g transform="translate(0 0)"><path class="trash-white" d="M63.331,124.769a1.305,1.305,0,0,0,1.351,1.168h5.771a1.328,1.328,0,0,0,1.374-1.191l.939-9.8H62.186Z" transform="translate(-60.01 -109.905)"/><path class="trash-white" d="M27.028,2.061h-4.26V1.328A1.283,1.283,0,0,0,21.533,0H18.577a1.282,1.282,0,0,0-1.306,1.259q0,.035,0,.07v.733h-4.26a.458.458,0,0,0,0,.916H27.028a.458.458,0,1,0,0-.916Zm-5.176-.733v.733H18.188V1.328a.366.366,0,0,1,.389-.412h2.886a.366.366,0,0,1,.391.34A.362.362,0,0,1,21.852,1.328Z" transform="translate(-12.554 0)"/></g></g></g></svg>
</button>
</div>
<p class="folder-wrapper__specification-sheet--wrapper-image-text">Go to product details</p>
</figcaption>
</figure>
</div>

<h3 class="folder-wrapper__specification-sheet--wrapper-heading">Material color</h3>

<p class="folder-wrapper__specification-sheet--wrapper-text">Closet organizers are the ultimate do it yourself project. They not only make your life simpler, they also bring about a lifetime of satisfaction. The Closets To Go closet organizers are the easiest to design and assemble. From our easy-to-adjust hanging bracket to the pre-assembly of all your hardware fittings and labeled panels, we've virtually made reading instructions a thing of the past. Our custom closet organizers are the easiest to install in the nation, guaranteed! They're also constructed with high-quality, environmentally-friendly materials made right here in the United States.</p>

<div class="folder-wrapper__specification-sheet--wrapper-image-wrap">
<figure class="folder-wrapper__specification-sheet--wrapper-image-box">
<img src="<?php echo SITEROOT; ?>images/idea-folder-room-5.png" alt="" class="folder-wrapper__specification-sheet--wrapper-image-img img-fluid">

<figcaption class="folder-wrapper__specification-sheet--wrapper-image-content">
<div class="folder-wrapper__specification-sheet--wrapper-image-buttons">
<button class="shere">
<svg xmlns="http://www.w3.org/2000/svg" width="23.547" height="25.688" viewBox="0 0 23.547 25.688"><defs><style>.share-white{fill:#fff;}</style></defs><g transform="translate(0)"><path class="share-white" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"/><path class="share-white" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"/><path class="share-white" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"/><path class="share-white" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"/><path class="share-white" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"/><path class="share-white" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"/><path class="share-white" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"/><path class="share-white" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"/></g></svg>
</button>
<button class="delete" data-toggle="modal" data-target="#deleteFolder">
<svg xmlns="http://www.w3.org/2000/svg" width="14.932" height="16.033" viewBox="0 0 14.932 16.033"><defs><style>.trash-white{fill:#fff;}</style></defs><g transform="translate(0 0)"><g transform="translate(0 0)"><g transform="translate(0 0)"><path class="trash-white" d="M63.331,124.769a1.305,1.305,0,0,0,1.351,1.168h5.771a1.328,1.328,0,0,0,1.374-1.191l.939-9.8H62.186Z" transform="translate(-60.01 -109.905)"/><path class="trash-white" d="M27.028,2.061h-4.26V1.328A1.283,1.283,0,0,0,21.533,0H18.577a1.282,1.282,0,0,0-1.306,1.259q0,.035,0,.07v.733h-4.26a.458.458,0,0,0,0,.916H27.028a.458.458,0,1,0,0-.916Zm-5.176-.733v.733H18.188V1.328a.366.366,0,0,1,.389-.412h2.886a.366.366,0,0,1,.391.34A.362.362,0,0,1,21.852,1.328Z" transform="translate(-12.554 0)"/></g></g></g></svg>
</button>
</div>
<p class="folder-wrapper__specification-sheet--wrapper-image-text">Go to product details</p>
</figcaption>
</figure>

<figure class="folder-wrapper__specification-sheet--wrapper-image-box">
<img src="<?php echo SITEROOT; ?>images/idea-folder-room-2.png" alt="" class="folder-wrapper__specification-sheet--wrapper-image-img img-fluid">

<figcaption class="folder-wrapper__specification-sheet--wrapper-image-content">
<div class="folder-wrapper__specification-sheet--wrapper-image-buttons">
<button class="shere">
<svg xmlns="http://www.w3.org/2000/svg" width="23.547" height="25.688" viewBox="0 0 23.547 25.688"><defs><style>.share-white{fill:#fff;}</style></defs><g transform="translate(0)"><path class="share-white" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"/><path class="share-white" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"/><path class="share-white" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"/><path class="share-white" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"/><path class="share-white" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"/><path class="share-white" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"/><path class="share-white" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"/><path class="share-white" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"/></g></svg>
</button>
<button class="delete" data-toggle="modal" data-target="#deleteFolder">
<svg xmlns="http://www.w3.org/2000/svg" width="14.932" height="16.033" viewBox="0 0 14.932 16.033"><defs><style>.trash-white{fill:#fff;}</style></defs><g transform="translate(0 0)"><g transform="translate(0 0)"><g transform="translate(0 0)"><path class="trash-white" d="M63.331,124.769a1.305,1.305,0,0,0,1.351,1.168h5.771a1.328,1.328,0,0,0,1.374-1.191l.939-9.8H62.186Z" transform="translate(-60.01 -109.905)"/><path class="trash-white" d="M27.028,2.061h-4.26V1.328A1.283,1.283,0,0,0,21.533,0H18.577a1.282,1.282,0,0,0-1.306,1.259q0,.035,0,.07v.733h-4.26a.458.458,0,0,0,0,.916H27.028a.458.458,0,1,0,0-.916Zm-5.176-.733v.733H18.188V1.328a.366.366,0,0,1,.389-.412h2.886a.366.366,0,0,1,.391.34A.362.362,0,0,1,21.852,1.328Z" transform="translate(-12.554 0)"/></g></g></g></svg>
</button>
</div>
<p class="folder-wrapper__specification-sheet--wrapper-image-text">Go to product details</p>
</figcaption>
</figure>

<figure class="folder-wrapper__specification-sheet--wrapper-image-box">
<img src="<?php echo SITEROOT; ?>images/idea-folder-room-3.png" alt="" class="folder-wrapper__specification-sheet--wrapper-image-img img-fluid">

<figcaption class="folder-wrapper__specification-sheet--wrapper-image-content">
<div class="folder-wrapper__specification-sheet--wrapper-image-buttons">
<button class="shere">
<svg xmlns="http://www.w3.org/2000/svg" width="23.547" height="25.688" viewBox="0 0 23.547 25.688"><defs><style>.share-white{fill:#fff;}</style></defs><g transform="translate(0)"><path class="share-white" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"/><path class="share-white" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"/><path class="share-white" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"/><path class="share-white" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"/><path class="share-white" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"/><path class="share-white" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"/><path class="share-white" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"/><path class="share-white" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"/></g></svg>
</button>
<button class="delete" data-toggle="modal" data-target="#deleteFolder">
<svg xmlns="http://www.w3.org/2000/svg" width="14.932" height="16.033" viewBox="0 0 14.932 16.033"><defs><style>.trash-white{fill:#fff;}</style></defs><g transform="translate(0 0)"><g transform="translate(0 0)"><g transform="translate(0 0)"><path class="trash-white" d="M63.331,124.769a1.305,1.305,0,0,0,1.351,1.168h5.771a1.328,1.328,0,0,0,1.374-1.191l.939-9.8H62.186Z" transform="translate(-60.01 -109.905)"/><path class="trash-white" d="M27.028,2.061h-4.26V1.328A1.283,1.283,0,0,0,21.533,0H18.577a1.282,1.282,0,0,0-1.306,1.259q0,.035,0,.07v.733h-4.26a.458.458,0,0,0,0,.916H27.028a.458.458,0,1,0,0-.916Zm-5.176-.733v.733H18.188V1.328a.366.366,0,0,1,.389-.412h2.886a.366.366,0,0,1,.391.34A.362.362,0,0,1,21.852,1.328Z" transform="translate(-12.554 0)"/></g></g></g></svg>
</button>
</div>
<p class="folder-wrapper__specification-sheet--wrapper-image-text">Go to product details</p>
</figcaption>
</figure>

<figure class="folder-wrapper__specification-sheet--wrapper-image-box">
<img src="<?php echo SITEROOT; ?>images/idea-folder-room-4.png" alt="" class="folder-wrapper__specification-sheet--wrapper-image-img img-fluid">

<figcaption class="folder-wrapper__specification-sheet--wrapper-image-content">
<div class="folder-wrapper__specification-sheet--wrapper-image-buttons">
<button class="shere">
<svg xmlns="http://www.w3.org/2000/svg" width="23.547" height="25.688" viewBox="0 0 23.547 25.688"><defs><style>.share-white{fill:#fff;}</style></defs><g transform="translate(0)"><path class="share-white" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"/><path class="share-white" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"/><path class="share-white" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"/><path class="share-white" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"/><path class="share-white" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"/><path class="share-white" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"/><path class="share-white" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"/><path class="share-white" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"/></g></svg>
</button>
<button class="delete" data-toggle="modal" data-target="#deleteFolder">
<svg xmlns="http://www.w3.org/2000/svg" width="14.932" height="16.033" viewBox="0 0 14.932 16.033"><defs><style>.trash-white{fill:#fff;}</style></defs><g transform="translate(0 0)"><g transform="translate(0 0)"><g transform="translate(0 0)"><path class="trash-white" d="M63.331,124.769a1.305,1.305,0,0,0,1.351,1.168h5.771a1.328,1.328,0,0,0,1.374-1.191l.939-9.8H62.186Z" transform="translate(-60.01 -109.905)"/><path class="trash-white" d="M27.028,2.061h-4.26V1.328A1.283,1.283,0,0,0,21.533,0H18.577a1.282,1.282,0,0,0-1.306,1.259q0,.035,0,.07v.733h-4.26a.458.458,0,0,0,0,.916H27.028a.458.458,0,1,0,0-.916Zm-5.176-.733v.733H18.188V1.328a.366.366,0,0,1,.389-.412h2.886a.366.366,0,0,1,.391.34A.362.362,0,0,1,21.852,1.328Z" transform="translate(-12.554 0)"/></g></g></g></svg>
</button>
</div>
<p class="folder-wrapper__specification-sheet--wrapper-image-text">Go to product details</p>
</figcaption>
</figure>
</div>

<h3 class="folder-wrapper__specification-sheet--wrapper-heading">Door/drawer style</h3>

<p class="folder-wrapper__specification-sheet--wrapper-text">There is no any items in category.</p>

<h3 class="folder-wrapper__specification-sheet--wrapper-heading">Decorative hardware (handles, knobs, hooks)</h3>

<div class="folder-wrapper__specification-sheet--wrapper-image-wrap">
<figure class="folder-wrapper__specification-sheet--wrapper-image-box">
<img src="<?php echo SITEROOT; ?>images/idea-folder-room-5.png" alt="" class="folder-wrapper__specification-sheet--wrapper-image-img img-fluid">

<figcaption class="folder-wrapper__specification-sheet--wrapper-image-content">
<div class="folder-wrapper__specification-sheet--wrapper-image-buttons">
<button class="shere">
<svg xmlns="http://www.w3.org/2000/svg" width="23.547" height="25.688" viewBox="0 0 23.547 25.688"><defs><style>.share-white{fill:#fff;}</style></defs><g transform="translate(0)"><path class="share-white" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"/><path class="share-white" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"/><path class="share-white" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"/><path class="share-white" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"/><path class="share-white" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"/><path class="share-white" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"/><path class="share-white" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"/><path class="share-white" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"/></g></svg>
</button>
<button class="delete" data-toggle="modal" data-target="#deleteFolder">
<svg xmlns="http://www.w3.org/2000/svg" width="14.932" height="16.033" viewBox="0 0 14.932 16.033"><defs><style>.trash-white{fill:#fff;}</style></defs><g transform="translate(0 0)"><g transform="translate(0 0)"><g transform="translate(0 0)"><path class="trash-white" d="M63.331,124.769a1.305,1.305,0,0,0,1.351,1.168h5.771a1.328,1.328,0,0,0,1.374-1.191l.939-9.8H62.186Z" transform="translate(-60.01 -109.905)"/><path class="trash-white" d="M27.028,2.061h-4.26V1.328A1.283,1.283,0,0,0,21.533,0H18.577a1.282,1.282,0,0,0-1.306,1.259q0,.035,0,.07v.733h-4.26a.458.458,0,0,0,0,.916H27.028a.458.458,0,1,0,0-.916Zm-5.176-.733v.733H18.188V1.328a.366.366,0,0,1,.389-.412h2.886a.366.366,0,0,1,.391.34A.362.362,0,0,1,21.852,1.328Z" transform="translate(-12.554 0)"/></g></g></g></svg>
</button>
</div>
<p class="folder-wrapper__specification-sheet--wrapper-image-text">Go to product details</p>
</figcaption>
</figure>

<figure class="folder-wrapper__specification-sheet--wrapper-image-box">
<img src="<?php echo SITEROOT; ?>images/idea-folder-room-2.png" alt="" class="folder-wrapper__specification-sheet--wrapper-image-img img-fluid">

<figcaption class="folder-wrapper__specification-sheet--wrapper-image-content">
<div class="folder-wrapper__specification-sheet--wrapper-image-buttons">
<button class="shere">
<svg xmlns="http://www.w3.org/2000/svg" width="23.547" height="25.688" viewBox="0 0 23.547 25.688"><defs><style>.share-white{fill:#fff;}</style></defs><g transform="translate(0)"><path class="share-white" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"/><path class="share-white" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"/><path class="share-white" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"/><path class="share-white" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"/><path class="share-white" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"/><path class="share-white" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"/><path class="share-white" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"/><path class="share-white" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"/></g></svg>
</button>
<button class="delete" data-toggle="modal" data-target="#deleteFolder">
<svg xmlns="http://www.w3.org/2000/svg" width="14.932" height="16.033" viewBox="0 0 14.932 16.033"><defs><style>.trash-white{fill:#fff;}</style></defs><g transform="translate(0 0)"><g transform="translate(0 0)"><g transform="translate(0 0)"><path class="trash-white" d="M63.331,124.769a1.305,1.305,0,0,0,1.351,1.168h5.771a1.328,1.328,0,0,0,1.374-1.191l.939-9.8H62.186Z" transform="translate(-60.01 -109.905)"/><path class="trash-white" d="M27.028,2.061h-4.26V1.328A1.283,1.283,0,0,0,21.533,0H18.577a1.282,1.282,0,0,0-1.306,1.259q0,.035,0,.07v.733h-4.26a.458.458,0,0,0,0,.916H27.028a.458.458,0,1,0,0-.916Zm-5.176-.733v.733H18.188V1.328a.366.366,0,0,1,.389-.412h2.886a.366.366,0,0,1,.391.34A.362.362,0,0,1,21.852,1.328Z" transform="translate(-12.554 0)"/></g></g></g></svg>
</button>
</div>
<p class="folder-wrapper__specification-sheet--wrapper-image-text">Go to product details</p>
</figcaption>
</figure>
</div>

<h3 class="folder-wrapper__specification-sheet--wrapper-heading">Wardrobe tube style and finish</h3>

<p class="folder-wrapper__specification-sheet--wrapper-text">Closet organizers are the ultimate do it yourself project. They not only make your life simpler, they also bring about a lifetime of satisfaction. The Closets To Go closet organizers are the easiest to design and assemble. From our easy-to-adjust hanging bracket to the pre-assembly of all your hardware fittings and labeled panels, we've virtually made reading instructions a thing of the past. Our custom closet organizers are the easiest to install in the nation, guaranteed! They're also constructed with high-quality, environmentally-friendly materials made right here in the United States.</p>

<div class="folder-wrapper__specification-sheet--wrapper-image-wrap">
<figure class="folder-wrapper__specification-sheet--wrapper-image-box">
<img src="<?php echo SITEROOT; ?>images/idea-folder-room-5.png" alt="" class="folder-wrapper__specification-sheet--wrapper-image-img img-fluid">

<figcaption class="folder-wrapper__specification-sheet--wrapper-image-content">
<div class="folder-wrapper__specification-sheet--wrapper-image-buttons">
<button class="shere">
<svg xmlns="http://www.w3.org/2000/svg" width="23.547" height="25.688" viewBox="0 0 23.547 25.688"><defs><style>.share-white{fill:#fff;}</style></defs><g transform="translate(0)"><path class="share-white" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"/><path class="share-white" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"/><path class="share-white" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"/><path class="share-white" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"/><path class="share-white" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"/><path class="share-white" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"/><path class="share-white" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"/><path class="share-white" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"/></g></svg>
</button>
<button class="delete" data-toggle="modal" data-target="#deleteFolder">
<svg xmlns="http://www.w3.org/2000/svg" width="14.932" height="16.033" viewBox="0 0 14.932 16.033"><defs><style>.trash-white{fill:#fff;}</style></defs><g transform="translate(0 0)"><g transform="translate(0 0)"><g transform="translate(0 0)"><path class="trash-white" d="M63.331,124.769a1.305,1.305,0,0,0,1.351,1.168h5.771a1.328,1.328,0,0,0,1.374-1.191l.939-9.8H62.186Z" transform="translate(-60.01 -109.905)"/><path class="trash-white" d="M27.028,2.061h-4.26V1.328A1.283,1.283,0,0,0,21.533,0H18.577a1.282,1.282,0,0,0-1.306,1.259q0,.035,0,.07v.733h-4.26a.458.458,0,0,0,0,.916H27.028a.458.458,0,1,0,0-.916Zm-5.176-.733v.733H18.188V1.328a.366.366,0,0,1,.389-.412h2.886a.366.366,0,0,1,.391.34A.362.362,0,0,1,21.852,1.328Z" transform="translate(-12.554 0)"/></g></g></g></svg>
</button>
</div>
<p class="folder-wrapper__specification-sheet--wrapper-image-text">Go to product details</p>
</figcaption>
</figure>

<figure class="folder-wrapper__specification-sheet--wrapper-image-box">
<img src="<?php echo SITEROOT; ?>images/idea-folder-room-2.png" alt="" class="folder-wrapper__specification-sheet--wrapper-image-img img-fluid">

<figcaption class="folder-wrapper__specification-sheet--wrapper-image-content">
<div class="folder-wrapper__specification-sheet--wrapper-image-buttons">
<button class="shere">
<svg xmlns="http://www.w3.org/2000/svg" width="23.547" height="25.688" viewBox="0 0 23.547 25.688"><defs><style>.share-white{fill:#fff;}</style></defs><g transform="translate(0)"><path class="share-white" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"/><path class="share-white" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"/><path class="share-white" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"/><path class="share-white" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"/><path class="share-white" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"/><path class="share-white" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"/><path class="share-white" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"/><path class="share-white" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"/></g></svg>
</button>
<button class="delete" data-toggle="modal" data-target="#deleteFolder">
<svg xmlns="http://www.w3.org/2000/svg" width="14.932" height="16.033" viewBox="0 0 14.932 16.033"><defs><style>.trash-white{fill:#fff;}</style></defs><g transform="translate(0 0)"><g transform="translate(0 0)"><g transform="translate(0 0)"><path class="trash-white" d="M63.331,124.769a1.305,1.305,0,0,0,1.351,1.168h5.771a1.328,1.328,0,0,0,1.374-1.191l.939-9.8H62.186Z" transform="translate(-60.01 -109.905)"/><path class="trash-white" d="M27.028,2.061h-4.26V1.328A1.283,1.283,0,0,0,21.533,0H18.577a1.282,1.282,0,0,0-1.306,1.259q0,.035,0,.07v.733h-4.26a.458.458,0,0,0,0,.916H27.028a.458.458,0,1,0,0-.916Zm-5.176-.733v.733H18.188V1.328a.366.366,0,0,1,.389-.412h2.886a.366.366,0,0,1,.391.34A.362.362,0,0,1,21.852,1.328Z" transform="translate(-12.554 0)"/></g></g></g></svg>
</button>
</div>
<p class="folder-wrapper__specification-sheet--wrapper-image-text">Go to product details</p>
</figcaption>
</figure>

<figure class="folder-wrapper__specification-sheet--wrapper-image-box">
<img src="<?php echo SITEROOT; ?>images/idea-folder-room-3.png" alt="" class="folder-wrapper__specification-sheet--wrapper-image-img img-fluid">

<figcaption class="folder-wrapper__specification-sheet--wrapper-image-content">
<div class="folder-wrapper__specification-sheet--wrapper-image-buttons">
<button class="shere">
<svg xmlns="http://www.w3.org/2000/svg" width="23.547" height="25.688" viewBox="0 0 23.547 25.688"><defs><style>.share-white{fill:#fff;}</style></defs><g transform="translate(0)"><path class="share-white" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"/><path class="share-white" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"/><path class="share-white" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"/><path class="share-white" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"/><path class="share-white" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"/><path class="share-white" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"/><path class="share-white" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"/><path class="share-white" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"/></g></svg>
</button>
<button class="delete" data-toggle="modal" data-target="#deleteFolder">
<svg xmlns="http://www.w3.org/2000/svg" width="14.932" height="16.033" viewBox="0 0 14.932 16.033"><defs><style>.trash-white{fill:#fff;}</style></defs><g transform="translate(0 0)"><g transform="translate(0 0)"><g transform="translate(0 0)"><path class="trash-white" d="M63.331,124.769a1.305,1.305,0,0,0,1.351,1.168h5.771a1.328,1.328,0,0,0,1.374-1.191l.939-9.8H62.186Z" transform="translate(-60.01 -109.905)"/><path class="trash-white" d="M27.028,2.061h-4.26V1.328A1.283,1.283,0,0,0,21.533,0H18.577a1.282,1.282,0,0,0-1.306,1.259q0,.035,0,.07v.733h-4.26a.458.458,0,0,0,0,.916H27.028a.458.458,0,1,0,0-.916Zm-5.176-.733v.733H18.188V1.328a.366.366,0,0,1,.389-.412h2.886a.366.366,0,0,1,.391.34A.362.362,0,0,1,21.852,1.328Z" transform="translate(-12.554 0)"/></g></g></g></svg>
</button>
</div>
<p class="folder-wrapper__specification-sheet--wrapper-image-text">Go to product details</p>
</figcaption>
</figure>

<figure class="folder-wrapper__specification-sheet--wrapper-image-box">
<img src="<?php echo SITEROOT; ?>images/idea-folder-room-4.png" alt="" class="folder-wrapper__specification-sheet--wrapper-image-img img-fluid">

<figcaption class="folder-wrapper__specification-sheet--wrapper-image-content">
<div class="folder-wrapper__specification-sheet--wrapper-image-buttons">
<button class="shere">
<svg xmlns="http://www.w3.org/2000/svg" width="23.547" height="25.688" viewBox="0 0 23.547 25.688"><defs><style>.share-white{fill:#fff;}</style></defs><g transform="translate(0)"><path class="share-white" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"/><path class="share-white" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"/><path class="share-white" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"/><path class="share-white" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"/><path class="share-white" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"/><path class="share-white" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"/><path class="share-white" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"/><path class="share-white" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"/></g></svg>
</button>
<button class="delete" data-toggle="modal" data-target="#deleteFolder">
<svg xmlns="http://www.w3.org/2000/svg" width="14.932" height="16.033" viewBox="0 0 14.932 16.033"><defs><style>.trash-white{fill:#fff;}</style></defs><g transform="translate(0 0)"><g transform="translate(0 0)"><g transform="translate(0 0)"><path class="trash-white" d="M63.331,124.769a1.305,1.305,0,0,0,1.351,1.168h5.771a1.328,1.328,0,0,0,1.374-1.191l.939-9.8H62.186Z" transform="translate(-60.01 -109.905)"/><path class="trash-white" d="M27.028,2.061h-4.26V1.328A1.283,1.283,0,0,0,21.533,0H18.577a1.282,1.282,0,0,0-1.306,1.259q0,.035,0,.07v.733h-4.26a.458.458,0,0,0,0,.916H27.028a.458.458,0,1,0,0-.916Zm-5.176-.733v.733H18.188V1.328a.366.366,0,0,1,.389-.412h2.886a.366.366,0,0,1,.391.34A.362.362,0,0,1,21.852,1.328Z" transform="translate(-12.554 0)"/></g></g></g></svg>
</button>
</div>
<p class="folder-wrapper__specification-sheet--wrapper-image-text">Go to product details</p>
</figcaption>
</figure>
</div>
</div>

<div class="folder-wrapper__specification-sheet--buttons-box">

<div class="folder-wrapper__specification-sheet--buttons-box-content">
<span class="folder-wrapper__specification-sheet--buttons-box-image">
<svg xmlns="http://www.w3.org/2000/svg" width="24.704" height="16.27" viewBox="0 0 24.704 16.27">
<g id="open-folder-black-and-white-variant" transform="translate(0 -87.578)">
<path id="Path_434" data-name="Path 434" d="M18.618,102.844a1.7,1.7,0,0,0,1.429-.84l4.57-8.648c.273-.526-.124-.84-.84-.84H19.163V90.451a1.3,1.3,0,0,0-1.293-1.293H6.573l-.838-2.2a.59.59,0,0,0-.551-.38H.6a.589.589,0,0,0-.59.593l.011,3.28L0,101.554a1.3,1.3,0,0,0,1.293,1.293m16.69-10.33H7.922a1.392,1.392,0,0,0-1.134.84l-4.109,8.311H1.293a.114.114,0,0,1-.114-.114v-13.8h3.6l.838,2.2a.59.59,0,0,0,.551.38h11.7a.114.114,0,0,1,.114.114v2.066Z" transform="translate(0 1)" fill="#fff"/>
</g>
</svg>
</span>

<button class="folder-wrapper__specification-sheet--button js-hide-specification-sheet-box-btn">
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 495.785 495.785" xml:space="preserve"><path id="XMLID_26_" d="M436.855,90.337L255.175,0.541c-1.62-0.801-3.533-0.707-5.084,0.249c-1.535,0.957-2.467,2.638-2.467,4.449  v36.834H56.017v453.713h105.924V147.996h85.684v36.833c0,1.812,0.932,3.492,2.467,4.449c1.551,0.956,3.464,1.052,5.084,0.249  l181.68-89.796c1.791-0.888,2.914-2.706,2.914-4.698C439.769,93.043,438.646,91.225,436.855,90.337z"/><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
../ Specification sheet
</button>
</div>

<button class="folder-wrapper__specification-sheet--button second-fixed-button js-to-top">
Top
</button>

<button class="folder-wrapper__specification-sheet--button second-button js-hide-specification-sheet-box-btn">
Back
</button>
</div>
</div>
</div>

<div class="col-12 js-add-to-rooms-new-idea-folder-images" style="display: none;">
<div class="new-idea-folder-images__wrapper">

<div class="new-idea-folder-images__buttons">

<div class="new-idea-folder-images__buttons-box-content">
<span class="new-idea-folder-images__buttons-box-image">
<svg xmlns="http://www.w3.org/2000/svg" width="24.704" height="16.27" viewBox="0 0 24.704 16.27">
<g id="open-folder-black-and-white-variant" transform="translate(0 -87.578)">
<path id="Path_434" data-name="Path 434" d="M18.618,102.844a1.7,1.7,0,0,0,1.429-.84l4.57-8.648c.273-.526-.124-.84-.84-.84H19.163V90.451a1.3,1.3,0,0,0-1.293-1.293H6.573l-.838-2.2a.59.59,0,0,0-.551-.38H.6a.589.589,0,0,0-.59.593l.011,3.28L0,101.554a1.3,1.3,0,0,0,1.293,1.293m16.69-10.33H7.922a1.392,1.392,0,0,0-1.134.84l-4.109,8.311H1.293a.114.114,0,0,1-.114-.114v-13.8h3.6l.838,2.2a.59.59,0,0,0,.551.38h11.7a.114.114,0,0,1,.114.114v2.066Z" transform="translate(0 1)" fill="#fff"></path>
</g>
</svg>
</span>

<button class="new-idea-folder-images__button first-button js-hide-add-to-rooms-new-idea-folder-images-btn">
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 495.785 495.785" xml:space="preserve"><path id="XMLID_26_" d="M436.855,90.337L255.175,0.541c-1.62-0.801-3.533-0.707-5.084,0.249c-1.535,0.957-2.467,2.638-2.467,4.449  v36.834H56.017v453.713h105.924V147.996h85.684v36.833c0,1.812,0.932,3.492,2.467,4.449c1.551,0.956,3.464,1.052,5.084,0.249  l181.68-89.796c1.791-0.888,2.914-2.706,2.914-4.698C439.769,93.043,438.646,91.225,436.855,90.337z"></path><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
../ Nice things for glob...
</button>
</div>

<button class="new-idea-folder-images__button back-btn js-hide-add-to-rooms-new-idea-folder-images-btn">
Back
</button>
</div>

<div class="folder-wrapper__saved-elements">
<figure class="folder-wrapper__saved-element add-new-button js-url-modal-btn" data-tab-parrent="#v-pills-living-room" data-button-positon="folder-name" data-toggle="modal" data-target="#newImageUrl">
<figcaption class="add-new-button__wrap">

<span class="svg-group">
<span class="svg-group__first">
<svg xmlns="http://www.w3.org/2000/svg" width="34.215" height="51.323" viewBox="0 0 34.215 51.323">
<path id="Path_451" data-name="Path 451" d="M161.684,17.839,146.714.731a2.134,2.134,0,0,0-3.216,0L128.529,17.839a2.137,2.137,0,0,0,1.608,3.546h8.554v27.8a2.139,2.139,0,0,0,2.138,2.138h8.554a2.139,2.139,0,0,0,2.138-2.138v-27.8h8.554a2.137,2.137,0,0,0,1.608-3.546Z" transform="translate(-127.998)" fill="#fff"/>
</svg>
</span>
<span class="svg-group__second">
<svg xmlns="http://www.w3.org/2000/svg" width="21.992" height="9.797" viewBox="0 0 21.992 9.797">
<path id="Path_448" data-name="Path 448" d="M20.286,207.506a1.764,1.764,0,0,0-1.764,1.764v4.5H3.586v-4.5a1.764,1.764,0,0,0-3.528,0v6.269A1.764,1.764,0,0,0,1.822,217.3H20.286a1.764,1.764,0,0,0,1.764-1.764V209.27A1.764,1.764,0,0,0,20.286,207.506Z" transform="translate(-0.058 -207.506)" fill="#fff"/>
</svg>
</span>
</span>

<p class="folder-wrapper__saved-element--folders-text">Add an external URL of image or upload an image from the device</p>
</figcaption>
</figure>
<figure class="folder-wrapper__saved-element">
<img src="<?php echo SITEROOT; ?>images/idea-folder-room-2.png" alt="" class="folder-wrapper__saved-element--img img-fluid">
<figcaption class="folder-wrapper__saved-element--text-box">
<div class="folder-wrapper__saved-element--buttons">
<button class="shere">
<svg xmlns="http://www.w3.org/2000/svg" width="23.547" height="25.688" viewBox="0 0 23.547 25.688"><defs><style>.share-white{fill:#fff;}</style></defs><g transform="translate(0)"><path class="share-white" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"/><path class="share-white" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"/><path class="share-white" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"/><path class="share-white" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"/><path class="share-white" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"/><path class="share-white" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"/><path class="share-white" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"/><path class="share-white" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"/></g></svg>
</button>
<button class="delete" data-toggle="modal" data-target="#deleteFolder">
<svg xmlns="http://www.w3.org/2000/svg" width="14.932" height="16.033" viewBox="0 0 14.932 16.033"><defs><style>.trash-white{fill:#fff;}</style></defs><g transform="translate(0 0)"><g transform="translate(0 0)"><g transform="translate(0 0)"><path class="trash-white" d="M63.331,124.769a1.305,1.305,0,0,0,1.351,1.168h5.771a1.328,1.328,0,0,0,1.374-1.191l.939-9.8H62.186Z" transform="translate(-60.01 -109.905)"/><path class="trash-white" d="M27.028,2.061h-4.26V1.328A1.283,1.283,0,0,0,21.533,0H18.577a1.282,1.282,0,0,0-1.306,1.259q0,.035,0,.07v.733h-4.26a.458.458,0,0,0,0,.916H27.028a.458.458,0,1,0,0-.916Zm-5.176-.733v.733H18.188V1.328a.366.366,0,0,1,.389-.412h2.886a.366.366,0,0,1,.391.34A.362.362,0,0,1,21.852,1.328Z" transform="translate(-12.554 0)"/></g></g></g></svg>
</button>
</div>
<div class="idea-folder-gallery">
<a href="images/idea-folder-room-2.png" title="Lorem ipsum" class="folder-wrapper__saved-element--text">
Preview
</a>
</div>
</figcaption>
</figure>
<figure class="folder-wrapper__saved-element">
<img src="<?php echo SITEROOT; ?>images/idea-folder-room-3.png" alt="" class="folder-wrapper__saved-element--img img-fluid">
<figcaption class="folder-wrapper__saved-element--text-box">
<div class="folder-wrapper__saved-element--buttons">
<button class="shere">
<svg xmlns="http://www.w3.org/2000/svg" width="23.547" height="25.688" viewBox="0 0 23.547 25.688"><defs><style>.share-white{fill:#fff;}</style></defs><g transform="translate(0)"><path class="share-white" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"/><path class="share-white" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"/><path class="share-white" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"/><path class="share-white" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"/><path class="share-white" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"/><path class="share-white" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"/><path class="share-white" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"/><path class="share-white" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"/></g></svg>
</button>
<button class="delete" data-toggle="modal" data-target="#deleteFolder">
<svg xmlns="http://www.w3.org/2000/svg" width="14.932" height="16.033" viewBox="0 0 14.932 16.033"><defs><style>.trash-white{fill:#fff;}</style></defs><g transform="translate(0 0)"><g transform="translate(0 0)"><g transform="translate(0 0)"><path class="trash-white" d="M63.331,124.769a1.305,1.305,0,0,0,1.351,1.168h5.771a1.328,1.328,0,0,0,1.374-1.191l.939-9.8H62.186Z" transform="translate(-60.01 -109.905)"/><path class="trash-white" d="M27.028,2.061h-4.26V1.328A1.283,1.283,0,0,0,21.533,0H18.577a1.282,1.282,0,0,0-1.306,1.259q0,.035,0,.07v.733h-4.26a.458.458,0,0,0,0,.916H27.028a.458.458,0,1,0,0-.916Zm-5.176-.733v.733H18.188V1.328a.366.366,0,0,1,.389-.412h2.886a.366.366,0,0,1,.391.34A.362.362,0,0,1,21.852,1.328Z" transform="translate(-12.554 0)"/></g></g></g></svg>
</button>
</div>
<div class="idea-folder-gallery">
<a href="images/idea-folder-room-3.png" title="Lorem ipsum" class="folder-wrapper__saved-element--text">
Preview
</a>
</div>
</figcaption>
</figure>
<figure class="folder-wrapper__saved-element">
<img src="<?php echo SITEROOT; ?>images/idea-folder-room-4.png" alt="" class="folder-wrapper__saved-element--img img-fluid">
<figcaption class="folder-wrapper__saved-element--text-box">
<div class="folder-wrapper__saved-element--buttons">
<button class="shere">
<svg xmlns="http://www.w3.org/2000/svg" width="23.547" height="25.688" viewBox="0 0 23.547 25.688"><defs><style>.share-white{fill:#fff;}</style></defs><g transform="translate(0)"><path class="share-white" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"/><path class="share-white" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"/><path class="share-white" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"/><path class="share-white" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"/><path class="share-white" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"/><path class="share-white" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"/><path class="share-white" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"/><path class="share-white" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"/></g></svg>
</button>
<button class="delete" data-toggle="modal" data-target="#deleteFolder">
<svg xmlns="http://www.w3.org/2000/svg" width="14.932" height="16.033" viewBox="0 0 14.932 16.033"><defs><style>.trash-white{fill:#fff;}</style></defs><g transform="translate(0 0)"><g transform="translate(0 0)"><g transform="translate(0 0)"><path class="trash-white" d="M63.331,124.769a1.305,1.305,0,0,0,1.351,1.168h5.771a1.328,1.328,0,0,0,1.374-1.191l.939-9.8H62.186Z" transform="translate(-60.01 -109.905)"/><path class="trash-white" d="M27.028,2.061h-4.26V1.328A1.283,1.283,0,0,0,21.533,0H18.577a1.282,1.282,0,0,0-1.306,1.259q0,.035,0,.07v.733h-4.26a.458.458,0,0,0,0,.916H27.028a.458.458,0,1,0,0-.916Zm-5.176-.733v.733H18.188V1.328a.366.366,0,0,1,.389-.412h2.886a.366.366,0,0,1,.391.34A.362.362,0,0,1,21.852,1.328Z" transform="translate(-12.554 0)"/></g></g></g></svg>
</button>
</div>																				
<div class="idea-folder-gallery">
<a href="images/idea-folder-room-4.png" title="Lorem ipsum" class="folder-wrapper__saved-element--text">
Preview
</a>
</div>
</figcaption>
</figure>
<figure class="folder-wrapper__saved-element">
<img src="<?php echo SITEROOT; ?>images/idea-folder-room-5.png" alt="" class="folder-wrapper__saved-element--img img-fluid">
<figcaption class="folder-wrapper__saved-element--text-box">
<div class="folder-wrapper__saved-element--buttons">
<button class="shere">
<svg xmlns="http://www.w3.org/2000/svg" width="23.547" height="25.688" viewBox="0 0 23.547 25.688"><defs><style>.share-white{fill:#fff;}</style></defs><g transform="translate(0)"><path class="share-white" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"/><path class="share-white" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"/><path class="share-white" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"/><path class="share-white" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"/><path class="share-white" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"/><path class="share-white" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"/><path class="share-white" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"/><path class="share-white" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"/></g></svg>
</button>
<button class="delete" data-toggle="modal" data-target="#deleteFolder">
<svg xmlns="http://www.w3.org/2000/svg" width="14.932" height="16.033" viewBox="0 0 14.932 16.033"><defs><style>.trash-white{fill:#fff;}</style></defs><g transform="translate(0 0)"><g transform="translate(0 0)"><g transform="translate(0 0)"><path class="trash-white" d="M63.331,124.769a1.305,1.305,0,0,0,1.351,1.168h5.771a1.328,1.328,0,0,0,1.374-1.191l.939-9.8H62.186Z" transform="translate(-60.01 -109.905)"/><path class="trash-white" d="M27.028,2.061h-4.26V1.328A1.283,1.283,0,0,0,21.533,0H18.577a1.282,1.282,0,0,0-1.306,1.259q0,.035,0,.07v.733h-4.26a.458.458,0,0,0,0,.916H27.028a.458.458,0,1,0,0-.916Zm-5.176-.733v.733H18.188V1.328a.366.366,0,0,1,.389-.412h2.886a.366.366,0,0,1,.391.34A.362.362,0,0,1,21.852,1.328Z" transform="translate(-12.554 0)"/></g></g></g></svg>
</button>
</div>
<div class="idea-folder-gallery">
<a href="images/idea-folder-room-5.png" title="Lorem ipsum" class="folder-wrapper__saved-element--text">
Preview
</a>
</div>
</figcaption>
</figure>
</div>
</div>
</div>
</div>
</div>
</div>


<div class="tab-pane fade" id="v-pills-bedroom" role="tabpanel" aria-labelledby="v-pills-bedroom-tab">
<div class="folder-wrapper">
<div class="desktop-show">
<div class="row mb-2">
<div class="col-8">
<h3 class="folder-wrapper__heading">Title house name 1 - Badroom</h3>
</div>
</div>
</div>
<div class="row">
<div class="col-12 js-saved-images-box">
<div class="new-idea-folder-images__wrapper">
<div class="new-idea-folder-images__buttons">

<p class="new-idea-folder-images__empty-text">
No saved files in Badroom!
</p>
</div>

<div class="mb-2">
<p class="idea-folder-empty-house__text">You can add them from our website or by adding external images by choosing the option below</p>
</div>

<div class="folder-wrapper__saved-elements">
<figure class="folder-wrapper__saved-element specification-sheet">
<figcaption class="folder-wrapper__saved-element--folders">
<span class="folder-wrapper__saved-element--folders-img">
<svg xmlns="http://www.w3.org/2000/svg" width="24.704" height="16.27" viewBox="0 0 24.704 16.27">
<g id="open-folder-black-and-white-variant" transform="translate(0 -87.578)">
<path id="Path_434" data-name="Path 434" d="M18.618,102.844a1.7,1.7,0,0,0,1.429-.84l4.57-8.648c.273-.526-.124-.84-.84-.84H19.163V90.451a1.3,1.3,0,0,0-1.293-1.293H6.573l-.838-2.2a.59.59,0,0,0-.551-.38H.6a.589.589,0,0,0-.59.593l.011,3.28L0,101.554a1.3,1.3,0,0,0,1.293,1.293m16.69-10.33H7.922a1.392,1.392,0,0,0-1.134.84l-4.109,8.311H1.293a.114.114,0,0,1-.114-.114v-13.8h3.6l.838,2.2a.59.59,0,0,0,.551.38h11.7a.114.114,0,0,1,.114.114v2.066Z" transform="translate(0 1)" fill="#fff"/>
</g>
</svg>
</span>
<div class="folder-wrapper__saved-element--buttons">
<button class="shere">
<svg xmlns="http://www.w3.org/2000/svg" width="23.547" height="25.688" viewBox="0 0 23.547 25.688"><defs><style>.share-white{fill:#fff;}</style></defs><g transform="translate(0)"><path class="share-white" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"/><path class="share-white" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"/><path class="share-white" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"/><path class="share-white" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"/><path class="share-white" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"/><path class="share-white" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"/><path class="share-white" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"/><path class="share-white" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"/></g></svg>
</button>
<button class="delete" data-toggle="modal" data-target="#deleteFolder">
<svg xmlns="http://www.w3.org/2000/svg" width="14.932" height="16.033" viewBox="0 0 14.932 16.033"><defs><style>.trash-white{fill:#fff;}</style></defs><g transform="translate(0 0)"><g transform="translate(0 0)"><g transform="translate(0 0)"><path class="trash-white" d="M63.331,124.769a1.305,1.305,0,0,0,1.351,1.168h5.771a1.328,1.328,0,0,0,1.374-1.191l.939-9.8H62.186Z" transform="translate(-60.01 -109.905)"/><path class="trash-white" d="M27.028,2.061h-4.26V1.328A1.283,1.283,0,0,0,21.533,0H18.577a1.282,1.282,0,0,0-1.306,1.259q0,.035,0,.07v.733h-4.26a.458.458,0,0,0,0,.916H27.028a.458.458,0,1,0,0-.916Zm-5.176-.733v.733H18.188V1.328a.366.366,0,0,1,.389-.412h2.886a.366.366,0,0,1,.391.34A.362.362,0,0,1,21.852,1.328Z" transform="translate(-12.554 0)"/></g></g></g></svg>
</button>
</div>
<p class="folder-wrapper__saved-element--text first">Specification sheet</p>
<button class="folder-wrapper__saved-element--folders-button"><span onClick="open_specs();">open folder</span></button>
</figcaption>
</figure>
<figure class="folder-wrapper__saved-element folders">
<figcaption class="folder-wrapper__saved-element--folders">
<span class="folder-wrapper__saved-element--folders-img">
<svg xmlns="http://www.w3.org/2000/svg" width="86" height="71.044" viewBox="0 0 86 71.044"><defs><style>.folder-orange{fill:#edb700;}</style></defs><g transform="translate(-10.667)"><g transform="translate(10.667 7.478)"><g transform="translate(0)"><path class="folder-orange" d="M87.319,53.884H44.1a5.6,5.6,0,0,1-5.321-3.836l-.329-.991a9.337,9.337,0,0,0-8.865-6.39H20.015a9.361,9.361,0,0,0-9.348,9.348v44.87a9.358,9.358,0,0,0,9.348,9.348H34.971a1.87,1.87,0,1,0,0-3.739H20.015a5.615,5.615,0,0,1-5.609-5.609V52.015a5.615,5.615,0,0,1,5.609-5.609h9.568A5.6,5.6,0,0,1,34.9,50.239l.333.995a9.337,9.337,0,0,0,8.865,6.39H87.319a5.615,5.615,0,0,1,5.609,5.609V96.884a5.615,5.615,0,0,1-5.609,5.609H72.363a1.87,1.87,0,0,0,0,3.739H87.319a9.356,9.356,0,0,0,9.348-9.348V63.232A9.358,9.358,0,0,0,87.319,53.884Z" transform="translate(-10.667 -42.667)"/></g></g><g transform="translate(14.406)"><path class="folder-orange" d="M101.174,0H41.348A9.361,9.361,0,0,0,32,9.348a1.87,1.87,0,0,0,3.739,0,5.615,5.615,0,0,1,5.609-5.609h59.826a5.615,5.615,0,0,1,5.609,5.609V20.565a1.87,1.87,0,1,0,3.739,0V9.348A9.359,9.359,0,0,0,101.174,0Z" transform="translate(-32)"/></g></g></svg>
</span>
<p class="folder-wrapper__saved-element--folders-text">Nice things for living room</p>
<button class="folder-wrapper__saved-element--folders-button js-show-add-to-rooms-new-idea-folder-images-btn">View folder</button>
</figcaption>
</figure>
<figure class="folder-wrapper__saved-element add-new-button js-url-modal-btn" data-tab-parrent="#v-pills-bedroom" data-button-positon="room-name" data-toggle="modal" data-target="#newImageUrl">
<figcaption class="add-new-button__wrap">

<span class="svg-group">
<span class="svg-group__first">
<svg xmlns="http://www.w3.org/2000/svg" width="34.215" height="51.323" viewBox="0 0 34.215 51.323">
<path id="Path_451" data-name="Path 451" d="M161.684,17.839,146.714.731a2.134,2.134,0,0,0-3.216,0L128.529,17.839a2.137,2.137,0,0,0,1.608,3.546h8.554v27.8a2.139,2.139,0,0,0,2.138,2.138h8.554a2.139,2.139,0,0,0,2.138-2.138v-27.8h8.554a2.137,2.137,0,0,0,1.608-3.546Z" transform="translate(-127.998)" fill="#fff"/>
</svg>
</span>
<span class="svg-group__second">
<svg xmlns="http://www.w3.org/2000/svg" width="21.992" height="9.797" viewBox="0 0 21.992 9.797">
<path id="Path_448" data-name="Path 448" d="M20.286,207.506a1.764,1.764,0,0,0-1.764,1.764v4.5H3.586v-4.5a1.764,1.764,0,0,0-3.528,0v6.269A1.764,1.764,0,0,0,1.822,217.3H20.286a1.764,1.764,0,0,0,1.764-1.764V209.27A1.764,1.764,0,0,0,20.286,207.506Z" transform="translate(-0.058 -207.506)" fill="#fff"/>
</svg>
</span>
</span>

<p class="folder-wrapper__saved-element--folders-text">Add an external URL of image or upload an image from the device</p>
</figcaption>
</figure>
</div>
</div>
</div>

<div class="col-12 js-specification-sheet-box" style="display: none;">
<div class="folder-wrapper__specification-sheet--wrapper">

<div class="folder-wrapper__specification-sheet--buttons-box">

<div class="folder-wrapper__specification-sheet--buttons-box-content">
<span class="folder-wrapper__specification-sheet--buttons-box-image">
<svg xmlns="http://www.w3.org/2000/svg" width="24.704" height="16.27" viewBox="0 0 24.704 16.27">
<g id="open-folder-black-and-white-variant" transform="translate(0 -87.578)">
<path id="Path_434" data-name="Path 434" d="M18.618,102.844a1.7,1.7,0,0,0,1.429-.84l4.57-8.648c.273-.526-.124-.84-.84-.84H19.163V90.451a1.3,1.3,0,0,0-1.293-1.293H6.573l-.838-2.2a.59.59,0,0,0-.551-.38H.6a.589.589,0,0,0-.59.593l.011,3.28L0,101.554a1.3,1.3,0,0,0,1.293,1.293m16.69-10.33H7.922a1.392,1.392,0,0,0-1.134.84l-4.109,8.311H1.293a.114.114,0,0,1-.114-.114v-13.8h3.6l.838,2.2a.59.59,0,0,0,.551.38h11.7a.114.114,0,0,1,.114.114v2.066Z" transform="translate(0 1)" fill="#fff"/>
</g>
</svg>
</span>

<button class="folder-wrapper__specification-sheet--button js-hide-specification-sheet-box-btn">
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 495.785 495.785" xml:space="preserve"><path id="XMLID_26_" d="M436.855,90.337L255.175,0.541c-1.62-0.801-3.533-0.707-5.084,0.249c-1.535,0.957-2.467,2.638-2.467,4.449  v36.834H56.017v453.713h105.924V147.996h85.684v36.833c0,1.812,0.932,3.492,2.467,4.449c1.551,0.956,3.464,1.052,5.084,0.249  l181.68-89.796c1.791-0.888,2.914-2.706,2.914-4.698C439.769,93.043,438.646,91.225,436.855,90.337z"/><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
../ Specification sheet
</button>
</div>

<div class="d-flex justify-content-center align-items-center">
<div class="house-checkbox">
<input class="custom-checkbox js-load-confirm-modal" id="checkbox-4" type="checkbox" value="value4" data-target="#confirmModal">
<label for="checkbox-4">Share with Closets To Go</label>
</div>

<button class="folder-wrapper__specification-sheet--button second-button js-hide-specification-sheet-box-btn">
Back
</button>
</div>
</div>

<div class="mt-2 mb-2">
<p class="idea-folder-empty-house__heading">No saved files in 'Nice things for Guest Room folder!</p>
<p class="idea-folder-empty-house__text">You can add them from our website or by adding external images by choosing the option below</p>
</div>

</div>
</div>

<div class="col-12 js-add-to-rooms-new-idea-folder-images" style="display: none;">
<div class="new-idea-folder-images__wrapper">

<div class="new-idea-folder-images__buttons">

<div class="new-idea-folder-images__buttons-box-content">
<span class="new-idea-folder-images__buttons-box-image">
<svg xmlns="http://www.w3.org/2000/svg" width="24.704" height="16.27" viewBox="0 0 24.704 16.27">
<g id="open-folder-black-and-white-variant" transform="translate(0 -87.578)">
<path id="Path_434" data-name="Path 434" d="M18.618,102.844a1.7,1.7,0,0,0,1.429-.84l4.57-8.648c.273-.526-.124-.84-.84-.84H19.163V90.451a1.3,1.3,0,0,0-1.293-1.293H6.573l-.838-2.2a.59.59,0,0,0-.551-.38H.6a.589.589,0,0,0-.59.593l.011,3.28L0,101.554a1.3,1.3,0,0,0,1.293,1.293m16.69-10.33H7.922a1.392,1.392,0,0,0-1.134.84l-4.109,8.311H1.293a.114.114,0,0,1-.114-.114v-13.8h3.6l.838,2.2a.59.59,0,0,0,.551.38h11.7a.114.114,0,0,1,.114.114v2.066Z" transform="translate(0 1)" fill="#fff"></path>
</g>
</svg>
</span>

<button class="new-idea-folder-images__button first-button js-hide-add-to-rooms-new-idea-folder-images-btn">
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 495.785 495.785" xml:space="preserve"><path id="XMLID_26_" d="M436.855,90.337L255.175,0.541c-1.62-0.801-3.533-0.707-5.084,0.249c-1.535,0.957-2.467,2.638-2.467,4.449  v36.834H56.017v453.713h105.924V147.996h85.684v36.833c0,1.812,0.932,3.492,2.467,4.449c1.551,0.956,3.464,1.052,5.084,0.249  l181.68-89.796c1.791-0.888,2.914-2.706,2.914-4.698C439.769,93.043,438.646,91.225,436.855,90.337z"></path><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
../ Nice things for glob...
</button>
</div>

<button class="new-idea-folder-images__button back-btn js-hide-add-to-rooms-new-idea-folder-images-btn">
Back
</button>
</div>

<div class="mt-2 mb-2">
<p class="idea-folder-empty-house__heading">No saved files in 'Nice things for Guest Room folder!</p>
<p class="idea-folder-empty-house__text">You can add them from our website or by adding external images by choosing the option below</p>
</div>

<div class="folder-wrapper__saved-elements">
<figure class="folder-wrapper__saved-element add-new-button js-url-modal-btn" data-tab-parrent="#v-pills-bedroom" data-button-positon="folder-name" data-toggle="modal" data-target="#newImageUrl">
<figcaption class="add-new-button__wrap">

<span class="svg-group">
<span class="svg-group__first">
<svg xmlns="http://www.w3.org/2000/svg" width="34.215" height="51.323" viewBox="0 0 34.215 51.323">
<path id="Path_451" data-name="Path 451" d="M161.684,17.839,146.714.731a2.134,2.134,0,0,0-3.216,0L128.529,17.839a2.137,2.137,0,0,0,1.608,3.546h8.554v27.8a2.139,2.139,0,0,0,2.138,2.138h8.554a2.139,2.139,0,0,0,2.138-2.138v-27.8h8.554a2.137,2.137,0,0,0,1.608-3.546Z" transform="translate(-127.998)" fill="#fff"/>
</svg>
</span>
<span class="svg-group__second">
<svg xmlns="http://www.w3.org/2000/svg" width="21.992" height="9.797" viewBox="0 0 21.992 9.797">
<path id="Path_448" data-name="Path 448" d="M20.286,207.506a1.764,1.764,0,0,0-1.764,1.764v4.5H3.586v-4.5a1.764,1.764,0,0,0-3.528,0v6.269A1.764,1.764,0,0,0,1.822,217.3H20.286a1.764,1.764,0,0,0,1.764-1.764V209.27A1.764,1.764,0,0,0,20.286,207.506Z" transform="translate(-0.058 -207.506)" fill="#fff"/>
</svg>
</span>
</span>

<p class="folder-wrapper__saved-element--folders-text">Add an external URL of image or upload an image from the device</p>
</figcaption>
</figure>
</div>
</div>
</div>
</div>
</div>
</div>


<div class="tab-pane fade" id="v-pills-kitchen" role="tabpanel" aria-labelledby="v-pills-kitchen-tab">
<div class="folder-wrapper">
<div class="desktop-show">
<div class="row mb-2">
<div class="col-8">
<h3 class="folder-wrapper__heading">Title house name 1 - Kitchen</h3>
</div>
</div>
</div>
<div class="row">
<div class="col-12 js-saved-images-box">
<div class="new-idea-folder-images__wrapper">
<div class="new-idea-folder-images__buttons">

<p class="new-idea-folder-images__empty-text">
No saved files in Kitchen!
</p>
</div>

<div class="mb-2">
<p class="idea-folder-empty-house__text">You can add them from our website or by adding external images by choosing the option below</p>
</div>

<div class="folder-wrapper__saved-elements">
<figure class="folder-wrapper__saved-element specification-sheet">
<figcaption class="folder-wrapper__saved-element--folders">
<span class="folder-wrapper__saved-element--folders-img">
<svg xmlns="http://www.w3.org/2000/svg" width="24.704" height="16.27" viewBox="0 0 24.704 16.27">
<g id="open-folder-black-and-white-variant" transform="translate(0 -87.578)">
<path id="Path_434" data-name="Path 434" d="M18.618,102.844a1.7,1.7,0,0,0,1.429-.84l4.57-8.648c.273-.526-.124-.84-.84-.84H19.163V90.451a1.3,1.3,0,0,0-1.293-1.293H6.573l-.838-2.2a.59.59,0,0,0-.551-.38H.6a.589.589,0,0,0-.59.593l.011,3.28L0,101.554a1.3,1.3,0,0,0,1.293,1.293m16.69-10.33H7.922a1.392,1.392,0,0,0-1.134.84l-4.109,8.311H1.293a.114.114,0,0,1-.114-.114v-13.8h3.6l.838,2.2a.59.59,0,0,0,.551.38h11.7a.114.114,0,0,1,.114.114v2.066Z" transform="translate(0 1)" fill="#fff"/>
</g>
</svg>
</span>
<div class="folder-wrapper__saved-element--buttons">
<button class="shere">
<svg xmlns="http://www.w3.org/2000/svg" width="23.547" height="25.688" viewBox="0 0 23.547 25.688"><defs><style>.share-white{fill:#fff;}</style></defs><g transform="translate(0)"><path class="share-white" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"/><path class="share-white" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"/><path class="share-white" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"/><path class="share-white" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"/><path class="share-white" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"/><path class="share-white" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"/><path class="share-white" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"/><path class="share-white" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"/></g></svg>
</button>
<button class="delete" data-toggle="modal" data-target="#deleteFolder">
<svg xmlns="http://www.w3.org/2000/svg" width="14.932" height="16.033" viewBox="0 0 14.932 16.033"><defs><style>.trash-white{fill:#fff;}</style></defs><g transform="translate(0 0)"><g transform="translate(0 0)"><g transform="translate(0 0)"><path class="trash-white" d="M63.331,124.769a1.305,1.305,0,0,0,1.351,1.168h5.771a1.328,1.328,0,0,0,1.374-1.191l.939-9.8H62.186Z" transform="translate(-60.01 -109.905)"/><path class="trash-white" d="M27.028,2.061h-4.26V1.328A1.283,1.283,0,0,0,21.533,0H18.577a1.282,1.282,0,0,0-1.306,1.259q0,.035,0,.07v.733h-4.26a.458.458,0,0,0,0,.916H27.028a.458.458,0,1,0,0-.916Zm-5.176-.733v.733H18.188V1.328a.366.366,0,0,1,.389-.412h2.886a.366.366,0,0,1,.391.34A.362.362,0,0,1,21.852,1.328Z" transform="translate(-12.554 0)"/></g></g></g></svg>
</button>
</div>
<p class="folder-wrapper__saved-element--text first">Specification sheet</p>
<button class="folder-wrapper__saved-element--folders-button"><span onClick="open_specs();">open folder</span></button>
</figcaption>
</figure>
<figure class="folder-wrapper__saved-element folders">
<figcaption class="folder-wrapper__saved-element--folders">
<span class="folder-wrapper__saved-element--folders-img">
<svg xmlns="http://www.w3.org/2000/svg" width="86" height="71.044" viewBox="0 0 86 71.044"><defs><style>.folder-orange{fill:#edb700;}</style></defs><g transform="translate(-10.667)"><g transform="translate(10.667 7.478)"><g transform="translate(0)"><path class="folder-orange" d="M87.319,53.884H44.1a5.6,5.6,0,0,1-5.321-3.836l-.329-.991a9.337,9.337,0,0,0-8.865-6.39H20.015a9.361,9.361,0,0,0-9.348,9.348v44.87a9.358,9.358,0,0,0,9.348,9.348H34.971a1.87,1.87,0,1,0,0-3.739H20.015a5.615,5.615,0,0,1-5.609-5.609V52.015a5.615,5.615,0,0,1,5.609-5.609h9.568A5.6,5.6,0,0,1,34.9,50.239l.333.995a9.337,9.337,0,0,0,8.865,6.39H87.319a5.615,5.615,0,0,1,5.609,5.609V96.884a5.615,5.615,0,0,1-5.609,5.609H72.363a1.87,1.87,0,0,0,0,3.739H87.319a9.356,9.356,0,0,0,9.348-9.348V63.232A9.358,9.358,0,0,0,87.319,53.884Z" transform="translate(-10.667 -42.667)"/></g></g><g transform="translate(14.406)"><path class="folder-orange" d="M101.174,0H41.348A9.361,9.361,0,0,0,32,9.348a1.87,1.87,0,0,0,3.739,0,5.615,5.615,0,0,1,5.609-5.609h59.826a5.615,5.615,0,0,1,5.609,5.609V20.565a1.87,1.87,0,1,0,3.739,0V9.348A9.359,9.359,0,0,0,101.174,0Z" transform="translate(-32)"/></g></g></svg>
</span>
<p class="folder-wrapper__saved-element--folders-text">Nice things for living room</p>
<button class="folder-wrapper__saved-element--folders-button js-show-add-to-rooms-new-idea-folder-images-btn">View folder</button>
</figcaption>
</figure>
<figure class="folder-wrapper__saved-element add-new-button js-url-modal-btn" data-tab-parrent="#v-pills-kitchen" data-button-positon="room-name" data-toggle="modal" data-target="#newImageUrl">
<figcaption class="add-new-button__wrap">

<span class="svg-group">
<span class="svg-group__first">
<svg xmlns="http://www.w3.org/2000/svg" width="34.215" height="51.323" viewBox="0 0 34.215 51.323">
<path id="Path_451" data-name="Path 451" d="M161.684,17.839,146.714.731a2.134,2.134,0,0,0-3.216,0L128.529,17.839a2.137,2.137,0,0,0,1.608,3.546h8.554v27.8a2.139,2.139,0,0,0,2.138,2.138h8.554a2.139,2.139,0,0,0,2.138-2.138v-27.8h8.554a2.137,2.137,0,0,0,1.608-3.546Z" transform="translate(-127.998)" fill="#fff"/>
</svg>
</span>
<span class="svg-group__second">
<svg xmlns="http://www.w3.org/2000/svg" width="21.992" height="9.797" viewBox="0 0 21.992 9.797">
<path id="Path_448" data-name="Path 448" d="M20.286,207.506a1.764,1.764,0,0,0-1.764,1.764v4.5H3.586v-4.5a1.764,1.764,0,0,0-3.528,0v6.269A1.764,1.764,0,0,0,1.822,217.3H20.286a1.764,1.764,0,0,0,1.764-1.764V209.27A1.764,1.764,0,0,0,20.286,207.506Z" transform="translate(-0.058 -207.506)" fill="#fff"/>
</svg>
</span>
</span>

<p class="folder-wrapper__saved-element--folders-text">Add an external URL of image or upload an image from the device</p>
</figcaption>
</figure>
</div>
</div>
</div>

<div class="col-12 js-specification-sheet-box" style="display: none;">
<div class="folder-wrapper__specification-sheet--wrapper">

<div class="folder-wrapper__specification-sheet--buttons-box">

<div class="folder-wrapper__specification-sheet--buttons-box-content">
<span class="folder-wrapper__specification-sheet--buttons-box-image">
<svg xmlns="http://www.w3.org/2000/svg" width="24.704" height="16.27" viewBox="0 0 24.704 16.27">
<g id="open-folder-black-and-white-variant" transform="translate(0 -87.578)">
<path id="Path_434" data-name="Path 434" d="M18.618,102.844a1.7,1.7,0,0,0,1.429-.84l4.57-8.648c.273-.526-.124-.84-.84-.84H19.163V90.451a1.3,1.3,0,0,0-1.293-1.293H6.573l-.838-2.2a.59.59,0,0,0-.551-.38H.6a.589.589,0,0,0-.59.593l.011,3.28L0,101.554a1.3,1.3,0,0,0,1.293,1.293m16.69-10.33H7.922a1.392,1.392,0,0,0-1.134.84l-4.109,8.311H1.293a.114.114,0,0,1-.114-.114v-13.8h3.6l.838,2.2a.59.59,0,0,0,.551.38h11.7a.114.114,0,0,1,.114.114v2.066Z" transform="translate(0 1)" fill="#fff"/>
</g>
</svg>
</span>

<button class="folder-wrapper__specification-sheet--button js-hide-specification-sheet-box-btn">
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 495.785 495.785" xml:space="preserve"><path id="XMLID_26_" d="M436.855,90.337L255.175,0.541c-1.62-0.801-3.533-0.707-5.084,0.249c-1.535,0.957-2.467,2.638-2.467,4.449  v36.834H56.017v453.713h105.924V147.996h85.684v36.833c0,1.812,0.932,3.492,2.467,4.449c1.551,0.956,3.464,1.052,5.084,0.249  l181.68-89.796c1.791-0.888,2.914-2.706,2.914-4.698C439.769,93.043,438.646,91.225,436.855,90.337z"/><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
../ Specification sheet
</button>
</div>

<div class="d-flex justify-content-center align-items-center">
<div class="house-checkbox">
<input class="custom-checkbox js-load-confirm-modal" id="checkbox-5" type="checkbox" value="value5" data-target="#confirmModal">
<label for="checkbox-5">Share with Closets To Go</label>
</div>

<button class="folder-wrapper__specification-sheet--button second-button js-hide-specification-sheet-box-btn">
Back
</button>
</div>
</div>

<div class="mt-2 mb-2">
<p class="idea-folder-empty-house__heading">No saved files in 'Nice things for Guest Room folder!</p>
<p class="idea-folder-empty-house__text">You can add them from our website or by adding external images by choosing the option below</p>
</div>

</div>
</div>

<div class="col-12 js-add-to-rooms-new-idea-folder-images" style="display: none;">
<div class="new-idea-folder-images__wrapper">

<div class="new-idea-folder-images__buttons">

<div class="new-idea-folder-images__buttons-box-content">
<span class="new-idea-folder-images__buttons-box-image">
<svg xmlns="http://www.w3.org/2000/svg" width="24.704" height="16.27" viewBox="0 0 24.704 16.27">
<g id="open-folder-black-and-white-variant" transform="translate(0 -87.578)">
<path id="Path_434" data-name="Path 434" d="M18.618,102.844a1.7,1.7,0,0,0,1.429-.84l4.57-8.648c.273-.526-.124-.84-.84-.84H19.163V90.451a1.3,1.3,0,0,0-1.293-1.293H6.573l-.838-2.2a.59.59,0,0,0-.551-.38H.6a.589.589,0,0,0-.59.593l.011,3.28L0,101.554a1.3,1.3,0,0,0,1.293,1.293m16.69-10.33H7.922a1.392,1.392,0,0,0-1.134.84l-4.109,8.311H1.293a.114.114,0,0,1-.114-.114v-13.8h3.6l.838,2.2a.59.59,0,0,0,.551.38h11.7a.114.114,0,0,1,.114.114v2.066Z" transform="translate(0 1)" fill="#fff"></path>
</g>
</svg>
</span>

<button class="new-idea-folder-images__button first-button js-hide-add-to-rooms-new-idea-folder-images-btn">
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 495.785 495.785" xml:space="preserve"><path id="XMLID_26_" d="M436.855,90.337L255.175,0.541c-1.62-0.801-3.533-0.707-5.084,0.249c-1.535,0.957-2.467,2.638-2.467,4.449  v36.834H56.017v453.713h105.924V147.996h85.684v36.833c0,1.812,0.932,3.492,2.467,4.449c1.551,0.956,3.464,1.052,5.084,0.249  l181.68-89.796c1.791-0.888,2.914-2.706,2.914-4.698C439.769,93.043,438.646,91.225,436.855,90.337z"></path><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
../ Nice things for glob...
</button>
</div>

<button class="new-idea-folder-images__button back-btn js-hide-add-to-rooms-new-idea-folder-images-btn">
Back
</button>
</div>

<div class="mt-2 mb-2">
<p class="idea-folder-empty-house__heading">No saved files in 'Nice things for Guest Room folder!</p>
<p class="idea-folder-empty-house__text">You can add them from our website or by adding external images by choosing the option below</p>
</div>

<div class="folder-wrapper__saved-elements">
<figure class="folder-wrapper__saved-element add-new-button js-url-modal-btn" data-tab-parrent="#v-pills-kitchen" data-button-positon="folder-name" data-toggle="modal" data-target="#newImageUrl">
<figcaption class="add-new-button__wrap">

<span class="svg-group">
<span class="svg-group__first">
<svg xmlns="http://www.w3.org/2000/svg" width="34.215" height="51.323" viewBox="0 0 34.215 51.323">
<path id="Path_451" data-name="Path 451" d="M161.684,17.839,146.714.731a2.134,2.134,0,0,0-3.216,0L128.529,17.839a2.137,2.137,0,0,0,1.608,3.546h8.554v27.8a2.139,2.139,0,0,0,2.138,2.138h8.554a2.139,2.139,0,0,0,2.138-2.138v-27.8h8.554a2.137,2.137,0,0,0,1.608-3.546Z" transform="translate(-127.998)" fill="#fff"/>
</svg>
</span>
<span class="svg-group__second">
<svg xmlns="http://www.w3.org/2000/svg" width="21.992" height="9.797" viewBox="0 0 21.992 9.797">
<path id="Path_448" data-name="Path 448" d="M20.286,207.506a1.764,1.764,0,0,0-1.764,1.764v4.5H3.586v-4.5a1.764,1.764,0,0,0-3.528,0v6.269A1.764,1.764,0,0,0,1.822,217.3H20.286a1.764,1.764,0,0,0,1.764-1.764V209.27A1.764,1.764,0,0,0,20.286,207.506Z" transform="translate(-0.058 -207.506)" fill="#fff"/>
</svg>
</span>
</span>

<p class="folder-wrapper__saved-element--folders-text">Add an external URL of image or upload an image from the device</p>
</figcaption>
</figure>
</div>
</div>
</div>
</div>
</div>
</div>


<div class="tab-pane fade" id="v-pills-dining-room" role="tabpanel" aria-labelledby="v-pills-dining-room-tab">
<div class="folder-wrapper">
<div class="desktop-show">
<div class="row mb-2">
<div class="col-8">
<h3 class="folder-wrapper__heading">Title house name 1 - Dining room</h3>
</div>
</div>
</div>
<div class="row">
<div class="col-12 js-saved-images-box">
<div class="new-idea-folder-images__wrapper">
<div class="new-idea-folder-images__buttons">

<p class="new-idea-folder-images__empty-text">
No saved files in Dining room!
</p>
</div>

<div class="mb-2">
<p class="idea-folder-empty-house__text">You can add them from our website or by adding external images by choosing the option below</p>
</div>

<div class="folder-wrapper__saved-elements">
<figure class="folder-wrapper__saved-element specification-sheet">
<figcaption class="folder-wrapper__saved-element--folders">
<span class="folder-wrapper__saved-element--folders-img">
<svg xmlns="http://www.w3.org/2000/svg" width="24.704" height="16.27" viewBox="0 0 24.704 16.27">
<g id="open-folder-black-and-white-variant" transform="translate(0 -87.578)">
<path id="Path_434" data-name="Path 434" d="M18.618,102.844a1.7,1.7,0,0,0,1.429-.84l4.57-8.648c.273-.526-.124-.84-.84-.84H19.163V90.451a1.3,1.3,0,0,0-1.293-1.293H6.573l-.838-2.2a.59.59,0,0,0-.551-.38H.6a.589.589,0,0,0-.59.593l.011,3.28L0,101.554a1.3,1.3,0,0,0,1.293,1.293m16.69-10.33H7.922a1.392,1.392,0,0,0-1.134.84l-4.109,8.311H1.293a.114.114,0,0,1-.114-.114v-13.8h3.6l.838,2.2a.59.59,0,0,0,.551.38h11.7a.114.114,0,0,1,.114.114v2.066Z" transform="translate(0 1)" fill="#fff"/>
</g>
</svg>
</span>
<div class="folder-wrapper__saved-element--buttons">
<button class="shere">
<svg xmlns="http://www.w3.org/2000/svg" width="23.547" height="25.688" viewBox="0 0 23.547 25.688"><defs><style>.share-white{fill:#fff;}</style></defs><g transform="translate(0)"><path class="share-white" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"/><path class="share-white" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"/><path class="share-white" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"/><path class="share-white" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"/><path class="share-white" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"/><path class="share-white" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"/><path class="share-white" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"/><path class="share-white" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"/></g></svg>
</button>
<button class="delete" data-toggle="modal" data-target="#deleteFolder">
<svg xmlns="http://www.w3.org/2000/svg" width="14.932" height="16.033" viewBox="0 0 14.932 16.033"><defs><style>.trash-white{fill:#fff;}</style></defs><g transform="translate(0 0)"><g transform="translate(0 0)"><g transform="translate(0 0)"><path class="trash-white" d="M63.331,124.769a1.305,1.305,0,0,0,1.351,1.168h5.771a1.328,1.328,0,0,0,1.374-1.191l.939-9.8H62.186Z" transform="translate(-60.01 -109.905)"/><path class="trash-white" d="M27.028,2.061h-4.26V1.328A1.283,1.283,0,0,0,21.533,0H18.577a1.282,1.282,0,0,0-1.306,1.259q0,.035,0,.07v.733h-4.26a.458.458,0,0,0,0,.916H27.028a.458.458,0,1,0,0-.916Zm-5.176-.733v.733H18.188V1.328a.366.366,0,0,1,.389-.412h2.886a.366.366,0,0,1,.391.34A.362.362,0,0,1,21.852,1.328Z" transform="translate(-12.554 0)"/></g></g></g></svg>
</button>
</div>
<p class="folder-wrapper__saved-element--text first">Specification sheet</p>
<button class="folder-wrapper__saved-element--folders-button"><span onClick="open_specs();">open folder</span></button>
</figcaption>
</figure>
<figure class="folder-wrapper__saved-element folders">
<figcaption class="folder-wrapper__saved-element--folders">
<span class="folder-wrapper__saved-element--folders-img">
<svg xmlns="http://www.w3.org/2000/svg" width="86" height="71.044" viewBox="0 0 86 71.044"><defs><style>.folder-orange{fill:#edb700;}</style></defs><g transform="translate(-10.667)"><g transform="translate(10.667 7.478)"><g transform="translate(0)"><path class="folder-orange" d="M87.319,53.884H44.1a5.6,5.6,0,0,1-5.321-3.836l-.329-.991a9.337,9.337,0,0,0-8.865-6.39H20.015a9.361,9.361,0,0,0-9.348,9.348v44.87a9.358,9.358,0,0,0,9.348,9.348H34.971a1.87,1.87,0,1,0,0-3.739H20.015a5.615,5.615,0,0,1-5.609-5.609V52.015a5.615,5.615,0,0,1,5.609-5.609h9.568A5.6,5.6,0,0,1,34.9,50.239l.333.995a9.337,9.337,0,0,0,8.865,6.39H87.319a5.615,5.615,0,0,1,5.609,5.609V96.884a5.615,5.615,0,0,1-5.609,5.609H72.363a1.87,1.87,0,0,0,0,3.739H87.319a9.356,9.356,0,0,0,9.348-9.348V63.232A9.358,9.358,0,0,0,87.319,53.884Z" transform="translate(-10.667 -42.667)"/></g></g><g transform="translate(14.406)"><path class="folder-orange" d="M101.174,0H41.348A9.361,9.361,0,0,0,32,9.348a1.87,1.87,0,0,0,3.739,0,5.615,5.615,0,0,1,5.609-5.609h59.826a5.615,5.615,0,0,1,5.609,5.609V20.565a1.87,1.87,0,1,0,3.739,0V9.348A9.359,9.359,0,0,0,101.174,0Z" transform="translate(-32)"/></g></g></svg>
</span>
<p class="folder-wrapper__saved-element--folders-text">Nice things for living room</p>
<button class="folder-wrapper__saved-element--folders-button js-show-add-to-rooms-new-idea-folder-images-btn">View folder</button>
</figcaption>
</figure>
<figure class="folder-wrapper__saved-element add-new-button js-url-modal-btn" data-tab-parrent="#v-pills-dining-room" data-button-positon="room-name" data-toggle="modal" data-target="#newImageUrl">
<figcaption class="add-new-button__wrap">

<span class="svg-group">
<span class="svg-group__first">
<svg xmlns="http://www.w3.org/2000/svg" width="34.215" height="51.323" viewBox="0 0 34.215 51.323">
<path id="Path_451" data-name="Path 451" d="M161.684,17.839,146.714.731a2.134,2.134,0,0,0-3.216,0L128.529,17.839a2.137,2.137,0,0,0,1.608,3.546h8.554v27.8a2.139,2.139,0,0,0,2.138,2.138h8.554a2.139,2.139,0,0,0,2.138-2.138v-27.8h8.554a2.137,2.137,0,0,0,1.608-3.546Z" transform="translate(-127.998)" fill="#fff"/>
</svg>
</span>
<span class="svg-group__second">
<svg xmlns="http://www.w3.org/2000/svg" width="21.992" height="9.797" viewBox="0 0 21.992 9.797">
<path id="Path_448" data-name="Path 448" d="M20.286,207.506a1.764,1.764,0,0,0-1.764,1.764v4.5H3.586v-4.5a1.764,1.764,0,0,0-3.528,0v6.269A1.764,1.764,0,0,0,1.822,217.3H20.286a1.764,1.764,0,0,0,1.764-1.764V209.27A1.764,1.764,0,0,0,20.286,207.506Z" transform="translate(-0.058 -207.506)" fill="#fff"/>
</svg>
</span>
</span>

<p class="folder-wrapper__saved-element--folders-text">Add an external URL of image or upload an image from the device</p>
</figcaption>
</figure>
</div>
</div>
</div>

<div class="col-12 js-specification-sheet-box" style="display: none;">
<div class="folder-wrapper__specification-sheet--wrapper">

<div class="folder-wrapper__specification-sheet--buttons-box">

<div class="folder-wrapper__specification-sheet--buttons-box-content">
<span class="folder-wrapper__specification-sheet--buttons-box-image">
<svg xmlns="http://www.w3.org/2000/svg" width="24.704" height="16.27" viewBox="0 0 24.704 16.27">
<g id="open-folder-black-and-white-variant" transform="translate(0 -87.578)">
<path id="Path_434" data-name="Path 434" d="M18.618,102.844a1.7,1.7,0,0,0,1.429-.84l4.57-8.648c.273-.526-.124-.84-.84-.84H19.163V90.451a1.3,1.3,0,0,0-1.293-1.293H6.573l-.838-2.2a.59.59,0,0,0-.551-.38H.6a.589.589,0,0,0-.59.593l.011,3.28L0,101.554a1.3,1.3,0,0,0,1.293,1.293m16.69-10.33H7.922a1.392,1.392,0,0,0-1.134.84l-4.109,8.311H1.293a.114.114,0,0,1-.114-.114v-13.8h3.6l.838,2.2a.59.59,0,0,0,.551.38h11.7a.114.114,0,0,1,.114.114v2.066Z" transform="translate(0 1)" fill="#fff"/>
</g>
</svg>
</span>

<button class="folder-wrapper__specification-sheet--button js-hide-specification-sheet-box-btn">
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 495.785 495.785" xml:space="preserve"><path id="XMLID_26_" d="M436.855,90.337L255.175,0.541c-1.62-0.801-3.533-0.707-5.084,0.249c-1.535,0.957-2.467,2.638-2.467,4.449  v36.834H56.017v453.713h105.924V147.996h85.684v36.833c0,1.812,0.932,3.492,2.467,4.449c1.551,0.956,3.464,1.052,5.084,0.249  l181.68-89.796c1.791-0.888,2.914-2.706,2.914-4.698C439.769,93.043,438.646,91.225,436.855,90.337z"/><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
../ Specification sheet
</button>
</div>

<div class="d-flex justify-content-center align-items-center">
<div class="house-checkbox">
<input class="custom-checkbox js-load-confirm-modal" id="checkbox-6" type="checkbox" value="value6" data-target="#confirmModal">
<label for="checkbox-6">Share with Closets To Go</label>
</div>

<button class="folder-wrapper__specification-sheet--button second-button js-hide-specification-sheet-box-btn">
Back
</button>
</div>
</div>

<div class="mt-2 mb-2">
<p class="idea-folder-empty-house__heading">No saved files in 'Nice things for Guest Room folder!</p>
<p class="idea-folder-empty-house__text">You can add them from our website or by adding external images by choosing the option below</p>
</div>

</div>
</div>

<div class="col-12 js-add-to-rooms-new-idea-folder-images" style="display: none;">
<div class="new-idea-folder-images__wrapper">

<div class="new-idea-folder-images__buttons">

<div class="new-idea-folder-images__buttons-box-content">
<span class="new-idea-folder-images__buttons-box-image">
<svg xmlns="http://www.w3.org/2000/svg" width="24.704" height="16.27" viewBox="0 0 24.704 16.27">
<g id="open-folder-black-and-white-variant" transform="translate(0 -87.578)">
<path id="Path_434" data-name="Path 434" d="M18.618,102.844a1.7,1.7,0,0,0,1.429-.84l4.57-8.648c.273-.526-.124-.84-.84-.84H19.163V90.451a1.3,1.3,0,0,0-1.293-1.293H6.573l-.838-2.2a.59.59,0,0,0-.551-.38H.6a.589.589,0,0,0-.59.593l.011,3.28L0,101.554a1.3,1.3,0,0,0,1.293,1.293m16.69-10.33H7.922a1.392,1.392,0,0,0-1.134.84l-4.109,8.311H1.293a.114.114,0,0,1-.114-.114v-13.8h3.6l.838,2.2a.59.59,0,0,0,.551.38h11.7a.114.114,0,0,1,.114.114v2.066Z" transform="translate(0 1)" fill="#fff"></path>
</g>
</svg>
</span>

<button class="new-idea-folder-images__button first-button js-hide-add-to-rooms-new-idea-folder-images-btn">
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 495.785 495.785" xml:space="preserve"><path id="XMLID_26_" d="M436.855,90.337L255.175,0.541c-1.62-0.801-3.533-0.707-5.084,0.249c-1.535,0.957-2.467,2.638-2.467,4.449  v36.834H56.017v453.713h105.924V147.996h85.684v36.833c0,1.812,0.932,3.492,2.467,4.449c1.551,0.956,3.464,1.052,5.084,0.249  l181.68-89.796c1.791-0.888,2.914-2.706,2.914-4.698C439.769,93.043,438.646,91.225,436.855,90.337z"></path><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
../ Nice things for glob...
</button>
</div>

<button class="new-idea-folder-images__button back-btn js-hide-add-to-rooms-new-idea-folder-images-btn">
Back
</button>
</div>

<div class="mt-2 mb-2">
<p class="idea-folder-empty-house__heading">No saved files in 'Nice things for Guest Room folder!</p>
<p class="idea-folder-empty-house__text">You can add them from our website or by adding external images by choosing the option below</p>
</div>

<div class="folder-wrapper__saved-elements">
<figure class="folder-wrapper__saved-element add-new-button js-url-modal-btn" data-tab-parrent="#v-pills-dining-room" data-button-positon="folder-name" data-toggle="modal" data-target="#newImageUrl">
<figcaption class="add-new-button__wrap">

<span class="svg-group">
<span class="svg-group__first">
<svg xmlns="http://www.w3.org/2000/svg" width="34.215" height="51.323" viewBox="0 0 34.215 51.323">
<path id="Path_451" data-name="Path 451" d="M161.684,17.839,146.714.731a2.134,2.134,0,0,0-3.216,0L128.529,17.839a2.137,2.137,0,0,0,1.608,3.546h8.554v27.8a2.139,2.139,0,0,0,2.138,2.138h8.554a2.139,2.139,0,0,0,2.138-2.138v-27.8h8.554a2.137,2.137,0,0,0,1.608-3.546Z" transform="translate(-127.998)" fill="#fff"/>
</svg>
</span>
<span class="svg-group__second">
<svg xmlns="http://www.w3.org/2000/svg" width="21.992" height="9.797" viewBox="0 0 21.992 9.797">
<path id="Path_448" data-name="Path 448" d="M20.286,207.506a1.764,1.764,0,0,0-1.764,1.764v4.5H3.586v-4.5a1.764,1.764,0,0,0-3.528,0v6.269A1.764,1.764,0,0,0,1.822,217.3H20.286a1.764,1.764,0,0,0,1.764-1.764V209.27A1.764,1.764,0,0,0,20.286,207.506Z" transform="translate(-0.058 -207.506)" fill="#fff"/>
</svg>
</span>
</span>

<p class="folder-wrapper__saved-element--folders-text">Add an external URL of image or upload an image from the device</p>
</figcaption>
</figure>
</div>
</div>
</div>
</div>
</div>
</div>


<div class="tab-pane fade" id="v-pills-family-room" role="tabpanel" aria-labelledby="v-pills-family-room-tab">
<div class="folder-wrapper">
<div class="desktop-show">
<div class="row mb-2">
<div class="col-8">
<h3 class="folder-wrapper__heading">Title house name 1 - Family room</h3>
</div>
</div>
</div>
<div class="row">
<div class="col-12 js-saved-images-box">
<div class="new-idea-folder-images__wrapper">
<div class="new-idea-folder-images__buttons">

<p class="new-idea-folder-images__empty-text">
No saved files in Family room!
</p>
</div>

<div class="mb-2">
<p class="idea-folder-empty-house__text">You can add them from our website or by adding external images by choosing the option below</p>
</div>

<div class="folder-wrapper__saved-elements">
<figure class="folder-wrapper__saved-element specification-sheet">
<figcaption class="folder-wrapper__saved-element--folders">
<span class="folder-wrapper__saved-element--folders-img">
<svg xmlns="http://www.w3.org/2000/svg" width="24.704" height="16.27" viewBox="0 0 24.704 16.27">
<g id="open-folder-black-and-white-variant" transform="translate(0 -87.578)">
<path id="Path_434" data-name="Path 434" d="M18.618,102.844a1.7,1.7,0,0,0,1.429-.84l4.57-8.648c.273-.526-.124-.84-.84-.84H19.163V90.451a1.3,1.3,0,0,0-1.293-1.293H6.573l-.838-2.2a.59.59,0,0,0-.551-.38H.6a.589.589,0,0,0-.59.593l.011,3.28L0,101.554a1.3,1.3,0,0,0,1.293,1.293m16.69-10.33H7.922a1.392,1.392,0,0,0-1.134.84l-4.109,8.311H1.293a.114.114,0,0,1-.114-.114v-13.8h3.6l.838,2.2a.59.59,0,0,0,.551.38h11.7a.114.114,0,0,1,.114.114v2.066Z" transform="translate(0 1)" fill="#fff"/>
</g>
</svg>
</span>
<div class="folder-wrapper__saved-element--buttons">
<button class="shere">
<svg xmlns="http://www.w3.org/2000/svg" width="23.547" height="25.688" viewBox="0 0 23.547 25.688"><defs><style>.share-white{fill:#fff;}</style></defs><g transform="translate(0)"><path class="share-white" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"/><path class="share-white" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"/><path class="share-white" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"/><path class="share-white" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"/><path class="share-white" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"/><path class="share-white" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"/><path class="share-white" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"/><path class="share-white" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"/></g></svg>
</button>
<button class="delete" data-toggle="modal" data-target="#deleteFolder">
<svg xmlns="http://www.w3.org/2000/svg" width="14.932" height="16.033" viewBox="0 0 14.932 16.033"><defs><style>.trash-white{fill:#fff;}</style></defs><g transform="translate(0 0)"><g transform="translate(0 0)"><g transform="translate(0 0)"><path class="trash-white" d="M63.331,124.769a1.305,1.305,0,0,0,1.351,1.168h5.771a1.328,1.328,0,0,0,1.374-1.191l.939-9.8H62.186Z" transform="translate(-60.01 -109.905)"/><path class="trash-white" d="M27.028,2.061h-4.26V1.328A1.283,1.283,0,0,0,21.533,0H18.577a1.282,1.282,0,0,0-1.306,1.259q0,.035,0,.07v.733h-4.26a.458.458,0,0,0,0,.916H27.028a.458.458,0,1,0,0-.916Zm-5.176-.733v.733H18.188V1.328a.366.366,0,0,1,.389-.412h2.886a.366.366,0,0,1,.391.34A.362.362,0,0,1,21.852,1.328Z" transform="translate(-12.554 0)"/></g></g></g></svg>
</button>
</div>
<p class="folder-wrapper__saved-element--text first">Specification sheet</p>
<button class="folder-wrapper__saved-element--folders-button"><span onClick="open_specs();">open folder</span></button>
</figcaption>
</figure>
<figure class="folder-wrapper__saved-element folders">
<figcaption class="folder-wrapper__saved-element--folders">
<span class="folder-wrapper__saved-element--folders-img">
<svg xmlns="http://www.w3.org/2000/svg" width="86" height="71.044" viewBox="0 0 86 71.044"><defs><style>.folder-orange{fill:#edb700;}</style></defs><g transform="translate(-10.667)"><g transform="translate(10.667 7.478)"><g transform="translate(0)"><path class="folder-orange" d="M87.319,53.884H44.1a5.6,5.6,0,0,1-5.321-3.836l-.329-.991a9.337,9.337,0,0,0-8.865-6.39H20.015a9.361,9.361,0,0,0-9.348,9.348v44.87a9.358,9.358,0,0,0,9.348,9.348H34.971a1.87,1.87,0,1,0,0-3.739H20.015a5.615,5.615,0,0,1-5.609-5.609V52.015a5.615,5.615,0,0,1,5.609-5.609h9.568A5.6,5.6,0,0,1,34.9,50.239l.333.995a9.337,9.337,0,0,0,8.865,6.39H87.319a5.615,5.615,0,0,1,5.609,5.609V96.884a5.615,5.615,0,0,1-5.609,5.609H72.363a1.87,1.87,0,0,0,0,3.739H87.319a9.356,9.356,0,0,0,9.348-9.348V63.232A9.358,9.358,0,0,0,87.319,53.884Z" transform="translate(-10.667 -42.667)"/></g></g><g transform="translate(14.406)"><path class="folder-orange" d="M101.174,0H41.348A9.361,9.361,0,0,0,32,9.348a1.87,1.87,0,0,0,3.739,0,5.615,5.615,0,0,1,5.609-5.609h59.826a5.615,5.615,0,0,1,5.609,5.609V20.565a1.87,1.87,0,1,0,3.739,0V9.348A9.359,9.359,0,0,0,101.174,0Z" transform="translate(-32)"/></g></g></svg>
</span>
<p class="folder-wrapper__saved-element--folders-text">Nice things for living room</p>
<button class="folder-wrapper__saved-element--folders-button js-show-add-to-rooms-new-idea-folder-images-btn">View folder</button>
</figcaption>
</figure>
<figure class="folder-wrapper__saved-element add-new-button js-url-modal-btn" data-tab-parrent="#v-pills-family-room" data-button-positon="room-name" data-toggle="modal" data-target="#newImageUrl">
<figcaption class="add-new-button__wrap">

<span class="svg-group">
<span class="svg-group__first">
<svg xmlns="http://www.w3.org/2000/svg" width="34.215" height="51.323" viewBox="0 0 34.215 51.323">
<path id="Path_451" data-name="Path 451" d="M161.684,17.839,146.714.731a2.134,2.134,0,0,0-3.216,0L128.529,17.839a2.137,2.137,0,0,0,1.608,3.546h8.554v27.8a2.139,2.139,0,0,0,2.138,2.138h8.554a2.139,2.139,0,0,0,2.138-2.138v-27.8h8.554a2.137,2.137,0,0,0,1.608-3.546Z" transform="translate(-127.998)" fill="#fff"/>
</svg>
</span>
<span class="svg-group__second">
<svg xmlns="http://www.w3.org/2000/svg" width="21.992" height="9.797" viewBox="0 0 21.992 9.797">
<path id="Path_448" data-name="Path 448" d="M20.286,207.506a1.764,1.764,0,0,0-1.764,1.764v4.5H3.586v-4.5a1.764,1.764,0,0,0-3.528,0v6.269A1.764,1.764,0,0,0,1.822,217.3H20.286a1.764,1.764,0,0,0,1.764-1.764V209.27A1.764,1.764,0,0,0,20.286,207.506Z" transform="translate(-0.058 -207.506)" fill="#fff"/>
</svg>
</span>
</span>

<p class="folder-wrapper__saved-element--folders-text">Add an external URL of image or upload an image from the device</p>
</figcaption>
</figure>
</div>
</div>
</div>

<div class="col-12 js-specification-sheet-box" style="display: none;">
<div class="folder-wrapper__specification-sheet--wrapper">

<div class="folder-wrapper__specification-sheet--buttons-box">

<div class="folder-wrapper__specification-sheet--buttons-box-content">
<span class="folder-wrapper__specification-sheet--buttons-box-image">
<svg xmlns="http://www.w3.org/2000/svg" width="24.704" height="16.27" viewBox="0 0 24.704 16.27">
<g id="open-folder-black-and-white-variant" transform="translate(0 -87.578)">
<path id="Path_434" data-name="Path 434" d="M18.618,102.844a1.7,1.7,0,0,0,1.429-.84l4.57-8.648c.273-.526-.124-.84-.84-.84H19.163V90.451a1.3,1.3,0,0,0-1.293-1.293H6.573l-.838-2.2a.59.59,0,0,0-.551-.38H.6a.589.589,0,0,0-.59.593l.011,3.28L0,101.554a1.3,1.3,0,0,0,1.293,1.293m16.69-10.33H7.922a1.392,1.392,0,0,0-1.134.84l-4.109,8.311H1.293a.114.114,0,0,1-.114-.114v-13.8h3.6l.838,2.2a.59.59,0,0,0,.551.38h11.7a.114.114,0,0,1,.114.114v2.066Z" transform="translate(0 1)" fill="#fff"/>
</g>
</svg>
</span>

<button class="folder-wrapper__specification-sheet--button js-hide-specification-sheet-box-btn">
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 495.785 495.785" xml:space="preserve"><path id="XMLID_26_" d="M436.855,90.337L255.175,0.541c-1.62-0.801-3.533-0.707-5.084,0.249c-1.535,0.957-2.467,2.638-2.467,4.449  v36.834H56.017v453.713h105.924V147.996h85.684v36.833c0,1.812,0.932,3.492,2.467,4.449c1.551,0.956,3.464,1.052,5.084,0.249  l181.68-89.796c1.791-0.888,2.914-2.706,2.914-4.698C439.769,93.043,438.646,91.225,436.855,90.337z"/><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
../ Specification sheet
</button>
</div>

<div class="d-flex justify-content-center align-items-center">
<div class="house-checkbox">
<input class="custom-checkbox js-load-confirm-modal" id="checkbox-7" type="checkbox" value="value7" data-target="#confirmModal">
<label for="checkbox-7">Share with Closets To Go</label>
</div>

<button class="folder-wrapper__specification-sheet--button second-button js-hide-specification-sheet-box-btn">
Back
</button>
</div>
</div>

<div class="mt-2 mb-2">
<p class="idea-folder-empty-house__heading">No saved files in 'Nice things for Guest Room folder!</p>
<p class="idea-folder-empty-house__text">You can add them from our website or by adding external images by choosing the option below</p>
</div>

</div>
</div>

<div class="col-12 js-add-to-rooms-new-idea-folder-images" style="display: none;">
<div class="new-idea-folder-images__wrapper">

<div class="new-idea-folder-images__buttons">

<div class="new-idea-folder-images__buttons-box-content">
<span class="new-idea-folder-images__buttons-box-image">
<svg xmlns="http://www.w3.org/2000/svg" width="24.704" height="16.27" viewBox="0 0 24.704 16.27">
<g id="open-folder-black-and-white-variant" transform="translate(0 -87.578)">
<path id="Path_434" data-name="Path 434" d="M18.618,102.844a1.7,1.7,0,0,0,1.429-.84l4.57-8.648c.273-.526-.124-.84-.84-.84H19.163V90.451a1.3,1.3,0,0,0-1.293-1.293H6.573l-.838-2.2a.59.59,0,0,0-.551-.38H.6a.589.589,0,0,0-.59.593l.011,3.28L0,101.554a1.3,1.3,0,0,0,1.293,1.293m16.69-10.33H7.922a1.392,1.392,0,0,0-1.134.84l-4.109,8.311H1.293a.114.114,0,0,1-.114-.114v-13.8h3.6l.838,2.2a.59.59,0,0,0,.551.38h11.7a.114.114,0,0,1,.114.114v2.066Z" transform="translate(0 1)" fill="#fff"></path>
</g>
</svg>
</span>

<button class="new-idea-folder-images__button first-button js-hide-add-to-rooms-new-idea-folder-images-btn">
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 495.785 495.785" xml:space="preserve"><path id="XMLID_26_" d="M436.855,90.337L255.175,0.541c-1.62-0.801-3.533-0.707-5.084,0.249c-1.535,0.957-2.467,2.638-2.467,4.449  v36.834H56.017v453.713h105.924V147.996h85.684v36.833c0,1.812,0.932,3.492,2.467,4.449c1.551,0.956,3.464,1.052,5.084,0.249  l181.68-89.796c1.791-0.888,2.914-2.706,2.914-4.698C439.769,93.043,438.646,91.225,436.855,90.337z"></path><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
../ Nice things for glob...
</button>
</div>

<button class="new-idea-folder-images__button back-btn js-hide-add-to-rooms-new-idea-folder-images-btn">
Back
</button>
</div>

<div class="mt-2 mb-2">
<p class="idea-folder-empty-house__heading">No saved files in 'Nice things for Guest Room folder!</p>
<p class="idea-folder-empty-house__text">You can add them from our website or by adding external images by choosing the option below</p>
</div>

<div class="folder-wrapper__saved-elements">
<figure class="folder-wrapper__saved-element add-new-button js-url-modal-btn" data-tab-parrent="#v-pills-dining-room" data-button-positon="folder-name" data-toggle="modal" data-target="#newImageUrl">
<figcaption class="add-new-button__wrap">

<span class="svg-group">
<span class="svg-group__first">
<svg xmlns="http://www.w3.org/2000/svg" width="34.215" height="51.323" viewBox="0 0 34.215 51.323">
<path id="Path_451" data-name="Path 451" d="M161.684,17.839,146.714.731a2.134,2.134,0,0,0-3.216,0L128.529,17.839a2.137,2.137,0,0,0,1.608,3.546h8.554v27.8a2.139,2.139,0,0,0,2.138,2.138h8.554a2.139,2.139,0,0,0,2.138-2.138v-27.8h8.554a2.137,2.137,0,0,0,1.608-3.546Z" transform="translate(-127.998)" fill="#fff"/>
</svg>
</span>
<span class="svg-group__second">
<svg xmlns="http://www.w3.org/2000/svg" width="21.992" height="9.797" viewBox="0 0 21.992 9.797">
<path id="Path_448" data-name="Path 448" d="M20.286,207.506a1.764,1.764,0,0,0-1.764,1.764v4.5H3.586v-4.5a1.764,1.764,0,0,0-3.528,0v6.269A1.764,1.764,0,0,0,1.822,217.3H20.286a1.764,1.764,0,0,0,1.764-1.764V209.27A1.764,1.764,0,0,0,20.286,207.506Z" transform="translate(-0.058 -207.506)" fill="#fff"/>
</svg>
</span>
</span>

<p class="folder-wrapper__saved-element--folders-text">Add an external URL of image or upload an image from the device</p>
</figcaption>
</figure>
</div>
</div>
</div>
</div>
</div>
</div>


<div class="tab-pane fade" id="v-pills-guest-room" role="tabpanel" aria-labelledby="v-pills-guest-room-tab">
<div class="folder-wrapper">
<div class="desktop-show">
<div class="row mb-2">
<div class="col-8">
<h3 class="folder-wrapper__heading">Title house name 1 - Guest room</h3>
</div>
</div>
</div>
<div class="row">
<div class="col-12 js-saved-images-box">
<div class="new-idea-folder-images__wrapper">
<div class="new-idea-folder-images__buttons">

<p class="new-idea-folder-images__empty-text">
No saved files in Guest room!
</p>
</div>

<div class="mb-2">
<p class="idea-folder-empty-house__text">You can add them from our website or by adding external images by choosing the option below</p>
</div>

<div class="folder-wrapper__saved-elements">
<figure class="folder-wrapper__saved-element specification-sheet">
<figcaption class="folder-wrapper__saved-element--folders">
<span class="folder-wrapper__saved-element--folders-img">
<svg xmlns="http://www.w3.org/2000/svg" width="24.704" height="16.27" viewBox="0 0 24.704 16.27">
<g id="open-folder-black-and-white-variant" transform="translate(0 -87.578)">
<path id="Path_434" data-name="Path 434" d="M18.618,102.844a1.7,1.7,0,0,0,1.429-.84l4.57-8.648c.273-.526-.124-.84-.84-.84H19.163V90.451a1.3,1.3,0,0,0-1.293-1.293H6.573l-.838-2.2a.59.59,0,0,0-.551-.38H.6a.589.589,0,0,0-.59.593l.011,3.28L0,101.554a1.3,1.3,0,0,0,1.293,1.293m16.69-10.33H7.922a1.392,1.392,0,0,0-1.134.84l-4.109,8.311H1.293a.114.114,0,0,1-.114-.114v-13.8h3.6l.838,2.2a.59.59,0,0,0,.551.38h11.7a.114.114,0,0,1,.114.114v2.066Z" transform="translate(0 1)" fill="#fff"/>
</g>
</svg>
</span>
<div class="folder-wrapper__saved-element--buttons">
<button class="shere">
<svg xmlns="http://www.w3.org/2000/svg" width="23.547" height="25.688" viewBox="0 0 23.547 25.688"><defs><style>.share-white{fill:#fff;}</style></defs><g transform="translate(0)"><path class="share-white" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"/><path class="share-white" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"/><path class="share-white" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"/><path class="share-white" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"/><path class="share-white" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"/><path class="share-white" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"/><path class="share-white" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"/><path class="share-white" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"/></g></svg>
</button>
<button class="delete" data-toggle="modal" data-target="#deleteFolder">
<svg xmlns="http://www.w3.org/2000/svg" width="14.932" height="16.033" viewBox="0 0 14.932 16.033"><defs><style>.trash-white{fill:#fff;}</style></defs><g transform="translate(0 0)"><g transform="translate(0 0)"><g transform="translate(0 0)"><path class="trash-white" d="M63.331,124.769a1.305,1.305,0,0,0,1.351,1.168h5.771a1.328,1.328,0,0,0,1.374-1.191l.939-9.8H62.186Z" transform="translate(-60.01 -109.905)"/><path class="trash-white" d="M27.028,2.061h-4.26V1.328A1.283,1.283,0,0,0,21.533,0H18.577a1.282,1.282,0,0,0-1.306,1.259q0,.035,0,.07v.733h-4.26a.458.458,0,0,0,0,.916H27.028a.458.458,0,1,0,0-.916Zm-5.176-.733v.733H18.188V1.328a.366.366,0,0,1,.389-.412h2.886a.366.366,0,0,1,.391.34A.362.362,0,0,1,21.852,1.328Z" transform="translate(-12.554 0)"/></g></g></g></svg>
</button>
</div>
<p class="folder-wrapper__saved-element--text first">Specification sheet</p>
<button class="folder-wrapper__saved-element--folders-button"><span onClick="open_specs();">open folder</span></button>
</figcaption>
</figure>
<figure class="folder-wrapper__saved-element folders">
<figcaption class="folder-wrapper__saved-element--folders">
<span class="folder-wrapper__saved-element--folders-img">
<svg xmlns="http://www.w3.org/2000/svg" width="86" height="71.044" viewBox="0 0 86 71.044"><defs><style>.folder-orange{fill:#edb700;}</style></defs><g transform="translate(-10.667)"><g transform="translate(10.667 7.478)"><g transform="translate(0)"><path class="folder-orange" d="M87.319,53.884H44.1a5.6,5.6,0,0,1-5.321-3.836l-.329-.991a9.337,9.337,0,0,0-8.865-6.39H20.015a9.361,9.361,0,0,0-9.348,9.348v44.87a9.358,9.358,0,0,0,9.348,9.348H34.971a1.87,1.87,0,1,0,0-3.739H20.015a5.615,5.615,0,0,1-5.609-5.609V52.015a5.615,5.615,0,0,1,5.609-5.609h9.568A5.6,5.6,0,0,1,34.9,50.239l.333.995a9.337,9.337,0,0,0,8.865,6.39H87.319a5.615,5.615,0,0,1,5.609,5.609V96.884a5.615,5.615,0,0,1-5.609,5.609H72.363a1.87,1.87,0,0,0,0,3.739H87.319a9.356,9.356,0,0,0,9.348-9.348V63.232A9.358,9.358,0,0,0,87.319,53.884Z" transform="translate(-10.667 -42.667)"/></g></g><g transform="translate(14.406)"><path class="folder-orange" d="M101.174,0H41.348A9.361,9.361,0,0,0,32,9.348a1.87,1.87,0,0,0,3.739,0,5.615,5.615,0,0,1,5.609-5.609h59.826a5.615,5.615,0,0,1,5.609,5.609V20.565a1.87,1.87,0,1,0,3.739,0V9.348A9.359,9.359,0,0,0,101.174,0Z" transform="translate(-32)"/></g></g></svg>
</span>
<p class="folder-wrapper__saved-element--folders-text">Nice things for living room</p>
<button class="folder-wrapper__saved-element--folders-button js-show-add-to-rooms-new-idea-folder-images-btn">View folder</button>
</figcaption>
</figure>
<figure class="folder-wrapper__saved-element add-new-button js-url-modal-btn" data-tab-parrent="#v-pills-guest-room" data-button-positon="room-name" data-toggle="modal" data-target="#newImageUrl">
<figcaption class="add-new-button__wrap">

<span class="svg-group">
<span class="svg-group__first">
<svg xmlns="http://www.w3.org/2000/svg" width="34.215" height="51.323" viewBox="0 0 34.215 51.323">
<path id="Path_451" data-name="Path 451" d="M161.684,17.839,146.714.731a2.134,2.134,0,0,0-3.216,0L128.529,17.839a2.137,2.137,0,0,0,1.608,3.546h8.554v27.8a2.139,2.139,0,0,0,2.138,2.138h8.554a2.139,2.139,0,0,0,2.138-2.138v-27.8h8.554a2.137,2.137,0,0,0,1.608-3.546Z" transform="translate(-127.998)" fill="#fff"/>
</svg>
</span>
<span class="svg-group__second">
<svg xmlns="http://www.w3.org/2000/svg" width="21.992" height="9.797" viewBox="0 0 21.992 9.797">
<path id="Path_448" data-name="Path 448" d="M20.286,207.506a1.764,1.764,0,0,0-1.764,1.764v4.5H3.586v-4.5a1.764,1.764,0,0,0-3.528,0v6.269A1.764,1.764,0,0,0,1.822,217.3H20.286a1.764,1.764,0,0,0,1.764-1.764V209.27A1.764,1.764,0,0,0,20.286,207.506Z" transform="translate(-0.058 -207.506)" fill="#fff"/>
</svg>
</span>
</span>

<p class="folder-wrapper__saved-element--folders-text">Add an external URL of image or upload an image from the device</p>
</figcaption>
</figure>
</div>
</div>
</div>

<div class="col-12 js-specification-sheet-box" style="display: none;">
<div class="folder-wrapper__specification-sheet--wrapper">

<div class="folder-wrapper__specification-sheet--buttons-box">

<div class="folder-wrapper__specification-sheet--buttons-box-content">
<span class="folder-wrapper__specification-sheet--buttons-box-image">
<svg xmlns="http://www.w3.org/2000/svg" width="24.704" height="16.27" viewBox="0 0 24.704 16.27">
<g id="open-folder-black-and-white-variant" transform="translate(0 -87.578)">
<path id="Path_434" data-name="Path 434" d="M18.618,102.844a1.7,1.7,0,0,0,1.429-.84l4.57-8.648c.273-.526-.124-.84-.84-.84H19.163V90.451a1.3,1.3,0,0,0-1.293-1.293H6.573l-.838-2.2a.59.59,0,0,0-.551-.38H.6a.589.589,0,0,0-.59.593l.011,3.28L0,101.554a1.3,1.3,0,0,0,1.293,1.293m16.69-10.33H7.922a1.392,1.392,0,0,0-1.134.84l-4.109,8.311H1.293a.114.114,0,0,1-.114-.114v-13.8h3.6l.838,2.2a.59.59,0,0,0,.551.38h11.7a.114.114,0,0,1,.114.114v2.066Z" transform="translate(0 1)" fill="#fff"/>
</g>
</svg>
</span>

<button class="folder-wrapper__specification-sheet--button js-hide-specification-sheet-box-btn">
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 495.785 495.785" xml:space="preserve"><path id="XMLID_26_" d="M436.855,90.337L255.175,0.541c-1.62-0.801-3.533-0.707-5.084,0.249c-1.535,0.957-2.467,2.638-2.467,4.449  v36.834H56.017v453.713h105.924V147.996h85.684v36.833c0,1.812,0.932,3.492,2.467,4.449c1.551,0.956,3.464,1.052,5.084,0.249  l181.68-89.796c1.791-0.888,2.914-2.706,2.914-4.698C439.769,93.043,438.646,91.225,436.855,90.337z"/><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
../ Specification sheet
</button>
</div>

<div class="d-flex justify-content-center align-items-center">
<div class="house-checkbox">
<input class="custom-checkbox js-load-confirm-modal" id="checkbox-8" type="checkbox" value="value8" data-target="#confirmModal">
<label for="checkbox-8">Share with Closets To Go</label>
</div>

<button class="folder-wrapper__specification-sheet--button second-button js-hide-specification-sheet-box-btn">
Back
</button>
</div>
</div>

<div class="mt-2 mb-2">
<p class="idea-folder-empty-house__heading">No saved files in 'Nice things for Guest Room folder!</p>
<p class="idea-folder-empty-house__text">You can add them from our website or by adding external images by choosing the option below</p>
</div>

</div>
</div>

<div class="col-12 js-add-to-rooms-new-idea-folder-images" style="display: none;">
<div class="new-idea-folder-images__wrapper">

<div class="new-idea-folder-images__buttons">

<div class="new-idea-folder-images__buttons-box-content">
<span class="new-idea-folder-images__buttons-box-image">
<svg xmlns="http://www.w3.org/2000/svg" width="24.704" height="16.27" viewBox="0 0 24.704 16.27">
<g id="open-folder-black-and-white-variant" transform="translate(0 -87.578)">
<path id="Path_434" data-name="Path 434" d="M18.618,102.844a1.7,1.7,0,0,0,1.429-.84l4.57-8.648c.273-.526-.124-.84-.84-.84H19.163V90.451a1.3,1.3,0,0,0-1.293-1.293H6.573l-.838-2.2a.59.59,0,0,0-.551-.38H.6a.589.589,0,0,0-.59.593l.011,3.28L0,101.554a1.3,1.3,0,0,0,1.293,1.293m16.69-10.33H7.922a1.392,1.392,0,0,0-1.134.84l-4.109,8.311H1.293a.114.114,0,0,1-.114-.114v-13.8h3.6l.838,2.2a.59.59,0,0,0,.551.38h11.7a.114.114,0,0,1,.114.114v2.066Z" transform="translate(0 1)" fill="#fff"></path>
</g>
</svg>
</span>

<button class="new-idea-folder-images__button first-button js-hide-add-to-rooms-new-idea-folder-images-btn">
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 495.785 495.785" xml:space="preserve"><path id="XMLID_26_" d="M436.855,90.337L255.175,0.541c-1.62-0.801-3.533-0.707-5.084,0.249c-1.535,0.957-2.467,2.638-2.467,4.449  v36.834H56.017v453.713h105.924V147.996h85.684v36.833c0,1.812,0.932,3.492,2.467,4.449c1.551,0.956,3.464,1.052,5.084,0.249  l181.68-89.796c1.791-0.888,2.914-2.706,2.914-4.698C439.769,93.043,438.646,91.225,436.855,90.337z"></path><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
../ Nice things for glob...
</button>
</div>

<button class="new-idea-folder-images__button back-btn js-hide-add-to-rooms-new-idea-folder-images-btn">
Back
</button>
</div>

<div class="mt-2 mb-2">
<p class="idea-folder-empty-house__heading">No saved files in 'Nice things for Guest Room folder!</p>
<p class="idea-folder-empty-house__text">You can add them from our website or by adding external images by choosing the option below</p>
</div>

<div class="folder-wrapper__saved-elements">
<figure class="folder-wrapper__saved-element add-new-button js-url-modal-btn" data-tab-parrent="#v-pills-guest-room" data-button-positon="folder-name" data-toggle="modal" data-target="#newImageUrl">
<figcaption class="add-new-button__wrap">

<span class="svg-group">
<span class="svg-group__first">
<svg xmlns="http://www.w3.org/2000/svg" width="34.215" height="51.323" viewBox="0 0 34.215 51.323">
<path id="Path_451" data-name="Path 451" d="M161.684,17.839,146.714.731a2.134,2.134,0,0,0-3.216,0L128.529,17.839a2.137,2.137,0,0,0,1.608,3.546h8.554v27.8a2.139,2.139,0,0,0,2.138,2.138h8.554a2.139,2.139,0,0,0,2.138-2.138v-27.8h8.554a2.137,2.137,0,0,0,1.608-3.546Z" transform="translate(-127.998)" fill="#fff"/>
</svg>
</span>
<span class="svg-group__second">
<svg xmlns="http://www.w3.org/2000/svg" width="21.992" height="9.797" viewBox="0 0 21.992 9.797">
<path id="Path_448" data-name="Path 448" d="M20.286,207.506a1.764,1.764,0,0,0-1.764,1.764v4.5H3.586v-4.5a1.764,1.764,0,0,0-3.528,0v6.269A1.764,1.764,0,0,0,1.822,217.3H20.286a1.764,1.764,0,0,0,1.764-1.764V209.27A1.764,1.764,0,0,0,20.286,207.506Z" transform="translate(-0.058 -207.506)" fill="#fff"/>
</svg>
</span>
</span>

<p class="folder-wrapper__saved-element--folders-text">Add an external URL of image or upload an image from the device</p>
</figcaption>
</figure>
</div>
</div>
</div>
</div>
</div>
</div>


<div class="tab-pane fade" id="v-pills-bathroom" role="tabpanel" aria-labelledby="v-pills-bathroom-tab">
<div class="folder-wrapper">
<div class="desktop-show">
<div class="row mb-2">
<div class="col-8">
<h3 class="folder-wrapper__heading">Title house name 1 - Bathroom</h3>
</div>
<div class="col-4">
<p class="folder-wrapper__all-items">
<span class="folder-wrapper__all-items--img">5</span> images / 
<span class="folder-wrapper__all-items--subfolders">1</span> subfolder
</p>
</div>
</div>
<div class="row mb-4">
<div class="col-6 d-flex align-items-center">
<button class="folder-wrapper__specification-sheet-top-btn js-show-specification-sheet-btn">
<span></span>
Specification sheet
</button>
<button class="folder-wrapper__info" data-toggle="modal" data-target="#specificationsSheetInfo">
<svg xmlns="http://www.w3.org/2000/svg" width="17.667" height="17.667" viewBox="0 0 17.667 17.667">
<g id="Info2Btn" transform="translate(-343 -723)">
<path id="Path_184" data-name="Path 184" d="M8.833,0a8.833,8.833,0,1,0,8.833,8.833A8.843,8.843,0,0,0,8.833,0Zm0,16.061a7.227,7.227,0,1,1,7.227-7.227A7.235,7.235,0,0,1,8.833,16.061Z" transform="translate(343 723)"/>
<path id="Path_185" data-name="Path 185" d="M146.072,70a1.071,1.071,0,1,0,1.07,1.071A1.072,1.072,0,0,0,146.072,70Z" transform="translate(205.761 656.747)"/>
<path id="Path_186" data-name="Path 186" d="M150.8,140a.8.8,0,0,0-.8.8v4.818a.8.8,0,0,0,1.606,0V140.8A.8.8,0,0,0,150.8,140Z" transform="translate(201.03 590.495)"/>
</g>
</svg>
</button>
</div>
<div class="col-6 text-right">
<div class="folder-wrapper__filters">
<div class="my-custom-select-wrapper">
<div class="my-custom-select">
<div class="my-custom-select__trigger"><span>Reorder by</span>
<div class="arrow"></div>
</div>
<div class="my-custom-options">
<span class="my-custom-option selected" data-value="Reorder by">Reorder by</span>
<span class="my-custom-option" data-value="Name">Name</span>
<span class="my-custom-option" data-value="Lastest">Lastest</span>
<span class="my-custom-option" data-value="Older">Older</span>
<span class="my-custom-option" data-value="Number of rooms">Number of rooms</span>
<span class="my-custom-option" data-value="Most visited">Most visited</span>
</div>
</div>
</div>

<div class="folder-wrapper__buttons">
<button class="shere">
<svg id="share" xmlns="http://www.w3.org/2000/svg" width="42.5" height="42.5" viewBox="0 0 42.5 42.5">
<path id="Path_226" data-name="Path 226" d="M2.5,0A2.5,2.5,0,1,1,0,2.5,2.5,2.5,0,0,1,2.5,0Z" transform="translate(10 19)" fill="#384765"></path>
<path id="Path_225" data-name="Path 225" d="M2.5,0A2.5,2.5,0,1,1,0,2.5,2.5,2.5,0,0,1,2.5,0Z" transform="translate(25 26)" fill="#384765"></path>
<path id="Path_224" data-name="Path 224" d="M2.5,0A2.5,2.5,0,1,1,0,2.5,2.5,2.5,0,0,1,2.5,0Z" transform="translate(25 11)" fill="#384765"></path>
<path id="Path_209" data-name="Path 209" d="M21.25,0A21.25,21.25,0,1,0,42.5,21.25,21.333,21.333,0,0,0,21.25,0ZM17.484,21.556l6.348,3.794a5.112,5.112,0,1,1-1.181,2.195l-5.96-3.562a5,5,0,1,1-.3-5.842l6.193-3.46a5.046,5.046,0,1,1,1.069,2.255L17.43,20.413a2.916,2.916,0,0,1,.054,1.143Z" fill="#384765"></path>
</svg>
</button>
<button class="delete" data-toggle="modal" data-target="#deleteFolder">
<svg xmlns="http://www.w3.org/2000/svg" width="43" height="43" viewBox="0 0 43 43">
<g id="trash" transform="translate(11.363 9.917)">
<circle id="Ellipse_36" data-name="Ellipse 36" cx="21.5" cy="21.5" r="21.5" transform="translate(-11.363 -9.917)" fill="#fb561b"></circle>
<path id="Path_408" data-name="Path 408" d="M63.808,128.863a1.849,1.849,0,0,0,1.914,1.655H73.9a1.882,1.882,0,0,0,1.947-1.687l1.33-13.886H62.186Z" transform="translate(-59.104 -107.806)" fill="#fff"></path>
<path id="Path_409" data-name="Path 409" d="M33.059,2.92H27.024V1.882A1.817,1.817,0,0,0,25.274,0H21.087a1.817,1.817,0,0,0-1.85,1.783q0,.049,0,.1V2.92H13.2a.649.649,0,0,0,0,1.3H33.059a.649.649,0,1,0,0-1.3ZM25.726,1.882V2.92H20.535V1.882a.519.519,0,0,1,.552-.584h4.088a.519.519,0,0,1,.554.481A.513.513,0,0,1,25.726,1.882Z" transform="translate(-12.554 0)" fill="#fff"></path>
</g>
</svg>
</button>
</div>
</div>
</div>
</div>
</div>
<div class="row">
<div class="col-12 js-saved-images-box">
<div class="folder-wrapper__saved-elements">
<figure class="folder-wrapper__saved-element specification-sheet">
<figcaption class="folder-wrapper__saved-element--folders">
<span class="folder-wrapper__saved-element--folders-img">
<svg xmlns="http://www.w3.org/2000/svg" width="24.704" height="16.27" viewBox="0 0 24.704 16.27">
<g id="open-folder-black-and-white-variant" transform="translate(0 -87.578)">
<path id="Path_434" data-name="Path 434" d="M18.618,102.844a1.7,1.7,0,0,0,1.429-.84l4.57-8.648c.273-.526-.124-.84-.84-.84H19.163V90.451a1.3,1.3,0,0,0-1.293-1.293H6.573l-.838-2.2a.59.59,0,0,0-.551-.38H.6a.589.589,0,0,0-.59.593l.011,3.28L0,101.554a1.3,1.3,0,0,0,1.293,1.293m16.69-10.33H7.922a1.392,1.392,0,0,0-1.134.84l-4.109,8.311H1.293a.114.114,0,0,1-.114-.114v-13.8h3.6l.838,2.2a.59.59,0,0,0,.551.38h11.7a.114.114,0,0,1,.114.114v2.066Z" transform="translate(0 1)" fill="#fff"/>
</g>
</svg>
</span>
<div class="folder-wrapper__saved-element--buttons">
<button class="shere">
<svg xmlns="http://www.w3.org/2000/svg" width="23.547" height="25.688" viewBox="0 0 23.547 25.688"><defs><style>.share-white{fill:#fff;}</style></defs><g transform="translate(0)"><path class="share-white" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"/><path class="share-white" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"/><path class="share-white" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"/><path class="share-white" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"/><path class="share-white" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"/><path class="share-white" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"/><path class="share-white" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"/><path class="share-white" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"/></g></svg>
</button>
<button class="delete" data-toggle="modal" data-target="#deleteFolder">
<svg xmlns="http://www.w3.org/2000/svg" width="14.932" height="16.033" viewBox="0 0 14.932 16.033"><defs><style>.trash-white{fill:#fff;}</style></defs><g transform="translate(0 0)"><g transform="translate(0 0)"><g transform="translate(0 0)"><path class="trash-white" d="M63.331,124.769a1.305,1.305,0,0,0,1.351,1.168h5.771a1.328,1.328,0,0,0,1.374-1.191l.939-9.8H62.186Z" transform="translate(-60.01 -109.905)"/><path class="trash-white" d="M27.028,2.061h-4.26V1.328A1.283,1.283,0,0,0,21.533,0H18.577a1.282,1.282,0,0,0-1.306,1.259q0,.035,0,.07v.733h-4.26a.458.458,0,0,0,0,.916H27.028a.458.458,0,1,0,0-.916Zm-5.176-.733v.733H18.188V1.328a.366.366,0,0,1,.389-.412h2.886a.366.366,0,0,1,.391.34A.362.362,0,0,1,21.852,1.328Z" transform="translate(-12.554 0)"/></g></g></g></svg>
</button>
</div>
<p class="folder-wrapper__saved-element--text first">Specification sheet</p>
<button class="folder-wrapper__saved-element--folders-button"><span onClick="open_specs();">open folder</span></button>
</figcaption>
</figure>
<figure class="folder-wrapper__saved-element add-new-button js-url-modal-btn" data-tab-parrent="#v-pills-bathroom" data-button-positon="room-name" data-toggle="modal" data-target="#newImageUrl">
<figcaption class="add-new-button__wrap">

<span class="svg-group">
<span class="svg-group__first">
<svg xmlns="http://www.w3.org/2000/svg" width="34.215" height="51.323" viewBox="0 0 34.215 51.323">
<path id="Path_451" data-name="Path 451" d="M161.684,17.839,146.714.731a2.134,2.134,0,0,0-3.216,0L128.529,17.839a2.137,2.137,0,0,0,1.608,3.546h8.554v27.8a2.139,2.139,0,0,0,2.138,2.138h8.554a2.139,2.139,0,0,0,2.138-2.138v-27.8h8.554a2.137,2.137,0,0,0,1.608-3.546Z" transform="translate(-127.998)" fill="#fff"/>
</svg>
</span>
<span class="svg-group__second">
<svg xmlns="http://www.w3.org/2000/svg" width="21.992" height="9.797" viewBox="0 0 21.992 9.797">
<path id="Path_448" data-name="Path 448" d="M20.286,207.506a1.764,1.764,0,0,0-1.764,1.764v4.5H3.586v-4.5a1.764,1.764,0,0,0-3.528,0v6.269A1.764,1.764,0,0,0,1.822,217.3H20.286a1.764,1.764,0,0,0,1.764-1.764V209.27A1.764,1.764,0,0,0,20.286,207.506Z" transform="translate(-0.058 -207.506)" fill="#fff"/>
</svg>
</span>
</span>

<p class="folder-wrapper__saved-element--folders-text">Add an external URL of image or upload an image from the device</p>
</figcaption>
</figure>
<figure class="folder-wrapper__saved-element">
<img src="<?php echo SITEROOT; ?>images/idea-folder-room-3.png" alt="" class="folder-wrapper__saved-element--img img-fluid">
<figcaption class="folder-wrapper__saved-element--text-box">
<a href="#" title="" class="folder-wrapper__saved-element--link"></a>
<div class="folder-wrapper__saved-element--buttons">
<button class="shere">
<svg xmlns="http://www.w3.org/2000/svg" width="23.547" height="25.688" viewBox="0 0 23.547 25.688"><defs><style>.share-white{fill:#fff;}</style></defs><g transform="translate(0)"><path class="share-white" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"/><path class="share-white" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"/><path class="share-white" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"/><path class="share-white" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"/><path class="share-white" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"/><path class="share-white" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"/><path class="share-white" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"/><path class="share-white" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"/></g></svg>
</button>
<button class="delete" data-toggle="modal" data-target="#deleteFolder">
<svg xmlns="http://www.w3.org/2000/svg" width="14.932" height="16.033" viewBox="0 0 14.932 16.033"><defs><style>.trash-white{fill:#fff;}</style></defs><g transform="translate(0 0)"><g transform="translate(0 0)"><g transform="translate(0 0)"><path class="trash-white" d="M63.331,124.769a1.305,1.305,0,0,0,1.351,1.168h5.771a1.328,1.328,0,0,0,1.374-1.191l.939-9.8H62.186Z" transform="translate(-60.01 -109.905)"/><path class="trash-white" d="M27.028,2.061h-4.26V1.328A1.283,1.283,0,0,0,21.533,0H18.577a1.282,1.282,0,0,0-1.306,1.259q0,.035,0,.07v.733h-4.26a.458.458,0,0,0,0,.916H27.028a.458.458,0,1,0,0-.916Zm-5.176-.733v.733H18.188V1.328a.366.366,0,0,1,.389-.412h2.886a.366.366,0,0,1,.391.34A.362.362,0,0,1,21.852,1.328Z" transform="translate(-12.554 0)"/></g></g></g></svg>
</button>
</div>
<p class="folder-wrapper__saved-element--text">Go to product details</p>
</figcaption>
</figure>
<figure class="folder-wrapper__saved-element">
<img src="<?php echo SITEROOT; ?>images/idea-folder-room-4.png" alt="" class="folder-wrapper__saved-element--img img-fluid">
<figcaption class="folder-wrapper__saved-element--text-box">
<a href="#" title="" class="folder-wrapper__saved-element--link"></a>
<div class="folder-wrapper__saved-element--buttons">
<button class="shere">
<svg xmlns="http://www.w3.org/2000/svg" width="23.547" height="25.688" viewBox="0 0 23.547 25.688"><defs><style>.share-white{fill:#fff;}</style></defs><g transform="translate(0)"><path class="share-white" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"/><path class="share-white" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"/><path class="share-white" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"/><path class="share-white" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"/><path class="share-white" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"/><path class="share-white" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"/><path class="share-white" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"/><path class="share-white" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"/></g></svg>
</button>
<button class="delete" data-toggle="modal" data-target="#deleteFolder">
<svg xmlns="http://www.w3.org/2000/svg" width="14.932" height="16.033" viewBox="0 0 14.932 16.033"><defs><style>.trash-white{fill:#fff;}</style></defs><g transform="translate(0 0)"><g transform="translate(0 0)"><g transform="translate(0 0)"><path class="trash-white" d="M63.331,124.769a1.305,1.305,0,0,0,1.351,1.168h5.771a1.328,1.328,0,0,0,1.374-1.191l.939-9.8H62.186Z" transform="translate(-60.01 -109.905)"/><path class="trash-white" d="M27.028,2.061h-4.26V1.328A1.283,1.283,0,0,0,21.533,0H18.577a1.282,1.282,0,0,0-1.306,1.259q0,.035,0,.07v.733h-4.26a.458.458,0,0,0,0,.916H27.028a.458.458,0,1,0,0-.916Zm-5.176-.733v.733H18.188V1.328a.366.366,0,0,1,.389-.412h2.886a.366.366,0,0,1,.391.34A.362.362,0,0,1,21.852,1.328Z" transform="translate(-12.554 0)"/></g></g></g></svg>
</button>
</div>
<p class="folder-wrapper__saved-element--text">Go to product details</p>
</figcaption>
</figure>
<figure class="folder-wrapper__saved-element">
<img src="<?php echo SITEROOT; ?>images/idea-folder-room-5.png" alt="" class="folder-wrapper__saved-element--img img-fluid">
<figcaption class="folder-wrapper__saved-element--text-box">
<a href="#" title="" class="folder-wrapper__saved-element--link"></a>
<div class="folder-wrapper__saved-element--buttons">
<button class="shere">
<svg xmlns="http://www.w3.org/2000/svg" width="23.547" height="25.688" viewBox="0 0 23.547 25.688"><defs><style>.share-white{fill:#fff;}</style></defs><g transform="translate(0)"><path class="share-white" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"/><path class="share-white" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"/><path class="share-white" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"/><path class="share-white" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"/><path class="share-white" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"/><path class="share-white" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"/><path class="share-white" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"/><path class="share-white" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"/></g></svg>
</button>
<button class="delete" data-toggle="modal" data-target="#deleteFolder">
<svg xmlns="http://www.w3.org/2000/svg" width="14.932" height="16.033" viewBox="0 0 14.932 16.033"><defs><style>.trash-white{fill:#fff;}</style></defs><g transform="translate(0 0)"><g transform="translate(0 0)"><g transform="translate(0 0)"><path class="trash-white" d="M63.331,124.769a1.305,1.305,0,0,0,1.351,1.168h5.771a1.328,1.328,0,0,0,1.374-1.191l.939-9.8H62.186Z" transform="translate(-60.01 -109.905)"/><path class="trash-white" d="M27.028,2.061h-4.26V1.328A1.283,1.283,0,0,0,21.533,0H18.577a1.282,1.282,0,0,0-1.306,1.259q0,.035,0,.07v.733h-4.26a.458.458,0,0,0,0,.916H27.028a.458.458,0,1,0,0-.916Zm-5.176-.733v.733H18.188V1.328a.366.366,0,0,1,.389-.412h2.886a.366.366,0,0,1,.391.34A.362.362,0,0,1,21.852,1.328Z" transform="translate(-12.554 0)"/></g></g></g></svg>
</button>
</div>
<p class="folder-wrapper__saved-element--text">Go to product details</p>
</figcaption>
</figure>
<figure class="folder-wrapper__saved-element folders">
<figcaption class="folder-wrapper__saved-element--folders">
<span class="folder-wrapper__saved-element--folders-img">
<svg xmlns="http://www.w3.org/2000/svg" width="86" height="71.044" viewBox="0 0 86 71.044"><defs><style>.folder-orange{fill:#edb700;}</style></defs><g transform="translate(-10.667)"><g transform="translate(10.667 7.478)"><g transform="translate(0)"><path class="folder-orange" d="M87.319,53.884H44.1a5.6,5.6,0,0,1-5.321-3.836l-.329-.991a9.337,9.337,0,0,0-8.865-6.39H20.015a9.361,9.361,0,0,0-9.348,9.348v44.87a9.358,9.358,0,0,0,9.348,9.348H34.971a1.87,1.87,0,1,0,0-3.739H20.015a5.615,5.615,0,0,1-5.609-5.609V52.015a5.615,5.615,0,0,1,5.609-5.609h9.568A5.6,5.6,0,0,1,34.9,50.239l.333.995a9.337,9.337,0,0,0,8.865,6.39H87.319a5.615,5.615,0,0,1,5.609,5.609V96.884a5.615,5.615,0,0,1-5.609,5.609H72.363a1.87,1.87,0,0,0,0,3.739H87.319a9.356,9.356,0,0,0,9.348-9.348V63.232A9.358,9.358,0,0,0,87.319,53.884Z" transform="translate(-10.667 -42.667)"/></g></g><g transform="translate(14.406)"><path class="folder-orange" d="M101.174,0H41.348A9.361,9.361,0,0,0,32,9.348a1.87,1.87,0,0,0,3.739,0,5.615,5.615,0,0,1,5.609-5.609h59.826a5.615,5.615,0,0,1,5.609,5.609V20.565a1.87,1.87,0,1,0,3.739,0V9.348A9.359,9.359,0,0,0,101.174,0Z" transform="translate(-32)"/></g></g></svg>
</span>
<p class="folder-wrapper__saved-element--folders-text">Nice things for living room</p>
<button class="folder-wrapper__saved-element--folders-button js-show-add-to-rooms-new-idea-folder-images-btn">View folder</button>
</figcaption>
</figure>
<figure class="folder-wrapper__saved-element">
<img src="<?php echo SITEROOT; ?>images/idea-folder-room-2.png" alt="" class="folder-wrapper__saved-element--img img-fluid">
<figcaption class="folder-wrapper__saved-element--text-box">
<a href="#" title="" class="folder-wrapper__saved-element--link"></a>
<div class="folder-wrapper__saved-element--buttons">
<button class="shere">
<svg xmlns="http://www.w3.org/2000/svg" width="23.547" height="25.688" viewBox="0 0 23.547 25.688"><defs><style>.share-white{fill:#fff;}</style></defs><g transform="translate(0)"><path class="share-white" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"/><path class="share-white" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"/><path class="share-white" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"/><path class="share-white" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"/><path class="share-white" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"/><path class="share-white" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"/><path class="share-white" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"/><path class="share-white" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"/></g></svg>
</button>
<button class="delete" data-toggle="modal" data-target="#deleteFolder">
<svg xmlns="http://www.w3.org/2000/svg" width="14.932" height="16.033" viewBox="0 0 14.932 16.033"><defs><style>.trash-white{fill:#fff;}</style></defs><g transform="translate(0 0)"><g transform="translate(0 0)"><g transform="translate(0 0)"><path class="trash-white" d="M63.331,124.769a1.305,1.305,0,0,0,1.351,1.168h5.771a1.328,1.328,0,0,0,1.374-1.191l.939-9.8H62.186Z" transform="translate(-60.01 -109.905)"/><path class="trash-white" d="M27.028,2.061h-4.26V1.328A1.283,1.283,0,0,0,21.533,0H18.577a1.282,1.282,0,0,0-1.306,1.259q0,.035,0,.07v.733h-4.26a.458.458,0,0,0,0,.916H27.028a.458.458,0,1,0,0-.916Zm-5.176-.733v.733H18.188V1.328a.366.366,0,0,1,.389-.412h2.886a.366.366,0,0,1,.391.34A.362.362,0,0,1,21.852,1.328Z" transform="translate(-12.554 0)"/></g></g></g></svg>
</button>
</div>
<p class="folder-wrapper__saved-element--text">Go to product details</p>
</figcaption>
</figure>
</div>
</div>

<div class="col-12 js-specification-sheet-box" style="display: none;">
<div class="folder-wrapper__specification-sheet--wrapper">

<div class="folder-wrapper__specification-sheet--buttons-box">

<div class="folder-wrapper__specification-sheet--buttons-box-content">
<span class="folder-wrapper__specification-sheet--buttons-box-image">
<svg xmlns="http://www.w3.org/2000/svg" width="24.704" height="16.27" viewBox="0 0 24.704 16.27">
<g id="open-folder-black-and-white-variant" transform="translate(0 -87.578)">
<path id="Path_434" data-name="Path 434" d="M18.618,102.844a1.7,1.7,0,0,0,1.429-.84l4.57-8.648c.273-.526-.124-.84-.84-.84H19.163V90.451a1.3,1.3,0,0,0-1.293-1.293H6.573l-.838-2.2a.59.59,0,0,0-.551-.38H.6a.589.589,0,0,0-.59.593l.011,3.28L0,101.554a1.3,1.3,0,0,0,1.293,1.293m16.69-10.33H7.922a1.392,1.392,0,0,0-1.134.84l-4.109,8.311H1.293a.114.114,0,0,1-.114-.114v-13.8h3.6l.838,2.2a.59.59,0,0,0,.551.38h11.7a.114.114,0,0,1,.114.114v2.066Z" transform="translate(0 1)" fill="#fff"/>
</g>
</svg>
</span>

<button class="folder-wrapper__specification-sheet--button js-hide-specification-sheet-box-btn">
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 495.785 495.785" xml:space="preserve"><path id="XMLID_26_" d="M436.855,90.337L255.175,0.541c-1.62-0.801-3.533-0.707-5.084,0.249c-1.535,0.957-2.467,2.638-2.467,4.449  v36.834H56.017v453.713h105.924V147.996h85.684v36.833c0,1.812,0.932,3.492,2.467,4.449c1.551,0.956,3.464,1.052,5.084,0.249  l181.68-89.796c1.791-0.888,2.914-2.706,2.914-4.698C439.769,93.043,438.646,91.225,436.855,90.337z"/><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
../ Specification sheet
</button>
</div>

<div class="d-flex justify-content-center align-items-center">
<div class="house-checkbox">
<input class="custom-checkbox js-load-confirm-modal" id="checkbox-9" type="checkbox" value="value9" data-target="#confirmModal">
<label for="checkbox-9">Share with Closets To Go</label>
</div>

<button class="folder-wrapper__specification-sheet--button second-button js-hide-specification-sheet-box-btn">
Back
</button>
</div>
</div>

<div class="folder-wrapper__specification-sheet--wrapper-content">
<h3 class="folder-wrapper__specification-sheet--wrapper-heading">Accessory</h3>

<div class="folder-wrapper__specification-sheet--wrapper-image-wrap">
<figure class="folder-wrapper__specification-sheet--wrapper-image-box">
<img src="<?php echo SITEROOT; ?>images/idea-folder-room-5.png" alt="" class="folder-wrapper__specification-sheet--wrapper-image-img img-fluid">

<figcaption class="folder-wrapper__specification-sheet--wrapper-image-content">
<div class="folder-wrapper__specification-sheet--wrapper-image-buttons">
<button class="shere">
<svg xmlns="http://www.w3.org/2000/svg" width="23.547" height="25.688" viewBox="0 0 23.547 25.688"><defs><style>.share-white{fill:#fff;}</style></defs><g transform="translate(0)"><path class="share-white" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"/><path class="share-white" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"/><path class="share-white" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"/><path class="share-white" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"/><path class="share-white" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"/><path class="share-white" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"/><path class="share-white" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"/><path class="share-white" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"/></g></svg>
</button>
<button class="delete" data-toggle="modal" data-target="#deleteFolder">
<svg xmlns="http://www.w3.org/2000/svg" width="14.932" height="16.033" viewBox="0 0 14.932 16.033"><defs><style>.trash-white{fill:#fff;}</style></defs><g transform="translate(0 0)"><g transform="translate(0 0)"><g transform="translate(0 0)"><path class="trash-white" d="M63.331,124.769a1.305,1.305,0,0,0,1.351,1.168h5.771a1.328,1.328,0,0,0,1.374-1.191l.939-9.8H62.186Z" transform="translate(-60.01 -109.905)"/><path class="trash-white" d="M27.028,2.061h-4.26V1.328A1.283,1.283,0,0,0,21.533,0H18.577a1.282,1.282,0,0,0-1.306,1.259q0,.035,0,.07v.733h-4.26a.458.458,0,0,0,0,.916H27.028a.458.458,0,1,0,0-.916Zm-5.176-.733v.733H18.188V1.328a.366.366,0,0,1,.389-.412h2.886a.366.366,0,0,1,.391.34A.362.362,0,0,1,21.852,1.328Z" transform="translate(-12.554 0)"/></g></g></g></svg>
</button>
</div>
<p class="folder-wrapper__specification-sheet--wrapper-image-text">Go to product details</p>
</figcaption>
</figure>

<figure class="folder-wrapper__specification-sheet--wrapper-image-box">
<img src="<?php echo SITEROOT; ?>images/idea-folder-room-2.png" alt="" class="folder-wrapper__specification-sheet--wrapper-image-img img-fluid">

<figcaption class="folder-wrapper__specification-sheet--wrapper-image-content">
<div class="folder-wrapper__specification-sheet--wrapper-image-buttons">
<button class="shere">
<svg xmlns="http://www.w3.org/2000/svg" width="23.547" height="25.688" viewBox="0 0 23.547 25.688"><defs><style>.share-white{fill:#fff;}</style></defs><g transform="translate(0)"><path class="share-white" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"/><path class="share-white" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"/><path class="share-white" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"/><path class="share-white" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"/><path class="share-white" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"/><path class="share-white" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"/><path class="share-white" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"/><path class="share-white" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"/></g></svg>
</button>
<button class="delete" data-toggle="modal" data-target="#deleteFolder">
<svg xmlns="http://www.w3.org/2000/svg" width="14.932" height="16.033" viewBox="0 0 14.932 16.033"><defs><style>.trash-white{fill:#fff;}</style></defs><g transform="translate(0 0)"><g transform="translate(0 0)"><g transform="translate(0 0)"><path class="trash-white" d="M63.331,124.769a1.305,1.305,0,0,0,1.351,1.168h5.771a1.328,1.328,0,0,0,1.374-1.191l.939-9.8H62.186Z" transform="translate(-60.01 -109.905)"/><path class="trash-white" d="M27.028,2.061h-4.26V1.328A1.283,1.283,0,0,0,21.533,0H18.577a1.282,1.282,0,0,0-1.306,1.259q0,.035,0,.07v.733h-4.26a.458.458,0,0,0,0,.916H27.028a.458.458,0,1,0,0-.916Zm-5.176-.733v.733H18.188V1.328a.366.366,0,0,1,.389-.412h2.886a.366.366,0,0,1,.391.34A.362.362,0,0,1,21.852,1.328Z" transform="translate(-12.554 0)"/></g></g></g></svg>
</button>
</div>
<p class="folder-wrapper__specification-sheet--wrapper-image-text">Go to product details</p>
</figcaption>
</figure>

<figure class="folder-wrapper__specification-sheet--wrapper-image-box">
<img src="<?php echo SITEROOT; ?>images/idea-folder-room-3.png" alt="" class="folder-wrapper__specification-sheet--wrapper-image-img img-fluid">

<figcaption class="folder-wrapper__specification-sheet--wrapper-image-content">
<div class="folder-wrapper__specification-sheet--wrapper-image-buttons">
<button class="shere">
<svg xmlns="http://www.w3.org/2000/svg" width="23.547" height="25.688" viewBox="0 0 23.547 25.688"><defs><style>.share-white{fill:#fff;}</style></defs><g transform="translate(0)"><path class="share-white" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"/><path class="share-white" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"/><path class="share-white" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"/><path class="share-white" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"/><path class="share-white" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"/><path class="share-white" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"/><path class="share-white" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"/><path class="share-white" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"/></g></svg>
</button>
<button class="delete" data-toggle="modal" data-target="#deleteFolder">
<svg xmlns="http://www.w3.org/2000/svg" width="14.932" height="16.033" viewBox="0 0 14.932 16.033"><defs><style>.trash-white{fill:#fff;}</style></defs><g transform="translate(0 0)"><g transform="translate(0 0)"><g transform="translate(0 0)"><path class="trash-white" d="M63.331,124.769a1.305,1.305,0,0,0,1.351,1.168h5.771a1.328,1.328,0,0,0,1.374-1.191l.939-9.8H62.186Z" transform="translate(-60.01 -109.905)"/><path class="trash-white" d="M27.028,2.061h-4.26V1.328A1.283,1.283,0,0,0,21.533,0H18.577a1.282,1.282,0,0,0-1.306,1.259q0,.035,0,.07v.733h-4.26a.458.458,0,0,0,0,.916H27.028a.458.458,0,1,0,0-.916Zm-5.176-.733v.733H18.188V1.328a.366.366,0,0,1,.389-.412h2.886a.366.366,0,0,1,.391.34A.362.362,0,0,1,21.852,1.328Z" transform="translate(-12.554 0)"/></g></g></g></svg>
</button>
</div>
<p class="folder-wrapper__specification-sheet--wrapper-image-text">Go to product details</p>
</figcaption>
</figure>
</div>

<h3 class="folder-wrapper__specification-sheet--wrapper-heading">Material color</h3>

<p class="folder-wrapper__specification-sheet--wrapper-text">Closet organizers are the ultimate do it yourself project. They not only make your life simpler, they also bring about a lifetime of satisfaction. The Closets To Go closet organizers are the easiest to design and assemble. From our easy-to-adjust hanging bracket to the pre-assembly of all your hardware fittings and labeled panels, we've virtually made reading instructions a thing of the past. Our custom closet organizers are the easiest to install in the nation, guaranteed! They're also constructed with high-quality, environmentally-friendly materials made right here in the United States.</p>

<div class="folder-wrapper__specification-sheet--wrapper-image-wrap">
<figure class="folder-wrapper__specification-sheet--wrapper-image-box">
<img src="<?php echo SITEROOT; ?>images/idea-folder-room-5.png" alt="" class="folder-wrapper__specification-sheet--wrapper-image-img img-fluid">

<figcaption class="folder-wrapper__specification-sheet--wrapper-image-content">
<div class="folder-wrapper__specification-sheet--wrapper-image-buttons">
<button class="shere">
<svg xmlns="http://www.w3.org/2000/svg" width="23.547" height="25.688" viewBox="0 0 23.547 25.688"><defs><style>.share-white{fill:#fff;}</style></defs><g transform="translate(0)"><path class="share-white" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"/><path class="share-white" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"/><path class="share-white" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"/><path class="share-white" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"/><path class="share-white" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"/><path class="share-white" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"/><path class="share-white" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"/><path class="share-white" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"/></g></svg>
</button>
<button class="delete" data-toggle="modal" data-target="#deleteFolder">
<svg xmlns="http://www.w3.org/2000/svg" width="14.932" height="16.033" viewBox="0 0 14.932 16.033"><defs><style>.trash-white{fill:#fff;}</style></defs><g transform="translate(0 0)"><g transform="translate(0 0)"><g transform="translate(0 0)"><path class="trash-white" d="M63.331,124.769a1.305,1.305,0,0,0,1.351,1.168h5.771a1.328,1.328,0,0,0,1.374-1.191l.939-9.8H62.186Z" transform="translate(-60.01 -109.905)"/><path class="trash-white" d="M27.028,2.061h-4.26V1.328A1.283,1.283,0,0,0,21.533,0H18.577a1.282,1.282,0,0,0-1.306,1.259q0,.035,0,.07v.733h-4.26a.458.458,0,0,0,0,.916H27.028a.458.458,0,1,0,0-.916Zm-5.176-.733v.733H18.188V1.328a.366.366,0,0,1,.389-.412h2.886a.366.366,0,0,1,.391.34A.362.362,0,0,1,21.852,1.328Z" transform="translate(-12.554 0)"/></g></g></g></svg>
</button>
</div>
<p class="folder-wrapper__specification-sheet--wrapper-image-text">Go to product details</p>
</figcaption>
</figure>

<figure class="folder-wrapper__specification-sheet--wrapper-image-box">
<img src="<?php echo SITEROOT; ?>images/idea-folder-room-2.png" alt="" class="folder-wrapper__specification-sheet--wrapper-image-img img-fluid">

<figcaption class="folder-wrapper__specification-sheet--wrapper-image-content">
<div class="folder-wrapper__specification-sheet--wrapper-image-buttons">
<button class="shere">
<svg xmlns="http://www.w3.org/2000/svg" width="23.547" height="25.688" viewBox="0 0 23.547 25.688"><defs><style>.share-white{fill:#fff;}</style></defs><g transform="translate(0)"><path class="share-white" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"/><path class="share-white" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"/><path class="share-white" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"/><path class="share-white" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"/><path class="share-white" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"/><path class="share-white" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"/><path class="share-white" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"/><path class="share-white" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"/></g></svg>
</button>
<button class="delete" data-toggle="modal" data-target="#deleteFolder">
<svg xmlns="http://www.w3.org/2000/svg" width="14.932" height="16.033" viewBox="0 0 14.932 16.033"><defs><style>.trash-white{fill:#fff;}</style></defs><g transform="translate(0 0)"><g transform="translate(0 0)"><g transform="translate(0 0)"><path class="trash-white" d="M63.331,124.769a1.305,1.305,0,0,0,1.351,1.168h5.771a1.328,1.328,0,0,0,1.374-1.191l.939-9.8H62.186Z" transform="translate(-60.01 -109.905)"/><path class="trash-white" d="M27.028,2.061h-4.26V1.328A1.283,1.283,0,0,0,21.533,0H18.577a1.282,1.282,0,0,0-1.306,1.259q0,.035,0,.07v.733h-4.26a.458.458,0,0,0,0,.916H27.028a.458.458,0,1,0,0-.916Zm-5.176-.733v.733H18.188V1.328a.366.366,0,0,1,.389-.412h2.886a.366.366,0,0,1,.391.34A.362.362,0,0,1,21.852,1.328Z" transform="translate(-12.554 0)"/></g></g></g></svg>
</button>
</div>
<p class="folder-wrapper__specification-sheet--wrapper-image-text">Go to product details</p>
</figcaption>
</figure>

<figure class="folder-wrapper__specification-sheet--wrapper-image-box">
<img src="<?php echo SITEROOT; ?>images/idea-folder-room-3.png" alt="" class="folder-wrapper__specification-sheet--wrapper-image-img img-fluid">

<figcaption class="folder-wrapper__specification-sheet--wrapper-image-content">
<div class="folder-wrapper__specification-sheet--wrapper-image-buttons">
<button class="shere">
<svg xmlns="http://www.w3.org/2000/svg" width="23.547" height="25.688" viewBox="0 0 23.547 25.688"><defs><style>.share-white{fill:#fff;}</style></defs><g transform="translate(0)"><path class="share-white" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"/><path class="share-white" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"/><path class="share-white" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"/><path class="share-white" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"/><path class="share-white" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"/><path class="share-white" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"/><path class="share-white" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"/><path class="share-white" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"/></g></svg>
</button>
<button class="delete" data-toggle="modal" data-target="#deleteFolder">
<svg xmlns="http://www.w3.org/2000/svg" width="14.932" height="16.033" viewBox="0 0 14.932 16.033"><defs><style>.trash-white{fill:#fff;}</style></defs><g transform="translate(0 0)"><g transform="translate(0 0)"><g transform="translate(0 0)"><path class="trash-white" d="M63.331,124.769a1.305,1.305,0,0,0,1.351,1.168h5.771a1.328,1.328,0,0,0,1.374-1.191l.939-9.8H62.186Z" transform="translate(-60.01 -109.905)"/><path class="trash-white" d="M27.028,2.061h-4.26V1.328A1.283,1.283,0,0,0,21.533,0H18.577a1.282,1.282,0,0,0-1.306,1.259q0,.035,0,.07v.733h-4.26a.458.458,0,0,0,0,.916H27.028a.458.458,0,1,0,0-.916Zm-5.176-.733v.733H18.188V1.328a.366.366,0,0,1,.389-.412h2.886a.366.366,0,0,1,.391.34A.362.362,0,0,1,21.852,1.328Z" transform="translate(-12.554 0)"/></g></g></g></svg>
</button>
</div>
<p class="folder-wrapper__specification-sheet--wrapper-image-text">Go to product details</p>
</figcaption>
</figure>

<figure class="folder-wrapper__specification-sheet--wrapper-image-box">
<img src="<?php echo SITEROOT; ?>images/idea-folder-room-4.png" alt="" class="folder-wrapper__specification-sheet--wrapper-image-img img-fluid">

<figcaption class="folder-wrapper__specification-sheet--wrapper-image-content">
<div class="folder-wrapper__specification-sheet--wrapper-image-buttons">
<button class="shere">
<svg xmlns="http://www.w3.org/2000/svg" width="23.547" height="25.688" viewBox="0 0 23.547 25.688"><defs><style>.share-white{fill:#fff;}</style></defs><g transform="translate(0)"><path class="share-white" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"/><path class="share-white" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"/><path class="share-white" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"/><path class="share-white" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"/><path class="share-white" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"/><path class="share-white" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"/><path class="share-white" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"/><path class="share-white" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"/></g></svg>
</button>
<button class="delete" data-toggle="modal" data-target="#deleteFolder">
<svg xmlns="http://www.w3.org/2000/svg" width="14.932" height="16.033" viewBox="0 0 14.932 16.033"><defs><style>.trash-white{fill:#fff;}</style></defs><g transform="translate(0 0)"><g transform="translate(0 0)"><g transform="translate(0 0)"><path class="trash-white" d="M63.331,124.769a1.305,1.305,0,0,0,1.351,1.168h5.771a1.328,1.328,0,0,0,1.374-1.191l.939-9.8H62.186Z" transform="translate(-60.01 -109.905)"/><path class="trash-white" d="M27.028,2.061h-4.26V1.328A1.283,1.283,0,0,0,21.533,0H18.577a1.282,1.282,0,0,0-1.306,1.259q0,.035,0,.07v.733h-4.26a.458.458,0,0,0,0,.916H27.028a.458.458,0,1,0,0-.916Zm-5.176-.733v.733H18.188V1.328a.366.366,0,0,1,.389-.412h2.886a.366.366,0,0,1,.391.34A.362.362,0,0,1,21.852,1.328Z" transform="translate(-12.554 0)"/></g></g></g></svg>
</button>
</div>
<p class="folder-wrapper__specification-sheet--wrapper-image-text">Go to product details</p>
</figcaption>
</figure>
</div>

<h3 class="folder-wrapper__specification-sheet--wrapper-heading">Door/drawer style</h3>

<p class="folder-wrapper__specification-sheet--wrapper-text">There is no any items in category.</p>

<h3 class="folder-wrapper__specification-sheet--wrapper-heading">Decorative hardware (handles, knobs, hooks)</h3>

<div class="folder-wrapper__specification-sheet--wrapper-image-wrap">
<figure class="folder-wrapper__specification-sheet--wrapper-image-box">
<img src="<?php echo SITEROOT; ?>images/idea-folder-room-5.png" alt="" class="folder-wrapper__specification-sheet--wrapper-image-img img-fluid">

<figcaption class="folder-wrapper__specification-sheet--wrapper-image-content">
<div class="folder-wrapper__specification-sheet--wrapper-image-buttons">
<button class="shere">
<svg xmlns="http://www.w3.org/2000/svg" width="23.547" height="25.688" viewBox="0 0 23.547 25.688"><defs><style>.share-white{fill:#fff;}</style></defs><g transform="translate(0)"><path class="share-white" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"/><path class="share-white" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"/><path class="share-white" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"/><path class="share-white" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"/><path class="share-white" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"/><path class="share-white" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"/><path class="share-white" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"/><path class="share-white" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"/></g></svg>
</button>
<button class="delete" data-toggle="modal" data-target="#deleteFolder">
<svg xmlns="http://www.w3.org/2000/svg" width="14.932" height="16.033" viewBox="0 0 14.932 16.033"><defs><style>.trash-white{fill:#fff;}</style></defs><g transform="translate(0 0)"><g transform="translate(0 0)"><g transform="translate(0 0)"><path class="trash-white" d="M63.331,124.769a1.305,1.305,0,0,0,1.351,1.168h5.771a1.328,1.328,0,0,0,1.374-1.191l.939-9.8H62.186Z" transform="translate(-60.01 -109.905)"/><path class="trash-white" d="M27.028,2.061h-4.26V1.328A1.283,1.283,0,0,0,21.533,0H18.577a1.282,1.282,0,0,0-1.306,1.259q0,.035,0,.07v.733h-4.26a.458.458,0,0,0,0,.916H27.028a.458.458,0,1,0,0-.916Zm-5.176-.733v.733H18.188V1.328a.366.366,0,0,1,.389-.412h2.886a.366.366,0,0,1,.391.34A.362.362,0,0,1,21.852,1.328Z" transform="translate(-12.554 0)"/></g></g></g></svg>
</button>
</div>
<p class="folder-wrapper__specification-sheet--wrapper-image-text">Go to product details</p>
</figcaption>
</figure>

<figure class="folder-wrapper__specification-sheet--wrapper-image-box">
<img src="<?php echo SITEROOT; ?>images/idea-folder-room-2.png" alt="" class="folder-wrapper__specification-sheet--wrapper-image-img img-fluid">

<figcaption class="folder-wrapper__specification-sheet--wrapper-image-content">
<div class="folder-wrapper__specification-sheet--wrapper-image-buttons">
<button class="shere">
<svg xmlns="http://www.w3.org/2000/svg" width="23.547" height="25.688" viewBox="0 0 23.547 25.688"><defs><style>.share-white{fill:#fff;}</style></defs><g transform="translate(0)"><path class="share-white" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"/><path class="share-white" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"/><path class="share-white" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"/><path class="share-white" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"/><path class="share-white" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"/><path class="share-white" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"/><path class="share-white" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"/><path class="share-white" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"/></g></svg>
</button>
<button class="delete" data-toggle="modal" data-target="#deleteFolder">
<svg xmlns="http://www.w3.org/2000/svg" width="14.932" height="16.033" viewBox="0 0 14.932 16.033"><defs><style>.trash-white{fill:#fff;}</style></defs><g transform="translate(0 0)"><g transform="translate(0 0)"><g transform="translate(0 0)"><path class="trash-white" d="M63.331,124.769a1.305,1.305,0,0,0,1.351,1.168h5.771a1.328,1.328,0,0,0,1.374-1.191l.939-9.8H62.186Z" transform="translate(-60.01 -109.905)"/><path class="trash-white" d="M27.028,2.061h-4.26V1.328A1.283,1.283,0,0,0,21.533,0H18.577a1.282,1.282,0,0,0-1.306,1.259q0,.035,0,.07v.733h-4.26a.458.458,0,0,0,0,.916H27.028a.458.458,0,1,0,0-.916Zm-5.176-.733v.733H18.188V1.328a.366.366,0,0,1,.389-.412h2.886a.366.366,0,0,1,.391.34A.362.362,0,0,1,21.852,1.328Z" transform="translate(-12.554 0)"/></g></g></g></svg>
</button>
</div>
<p class="folder-wrapper__specification-sheet--wrapper-image-text">Go to product details</p>
</figcaption>
</figure>
</div>

<h3 class="folder-wrapper__specification-sheet--wrapper-heading">Wardrobe tube style and finish</h3>

<p class="folder-wrapper__specification-sheet--wrapper-text">Closet organizers are the ultimate do it yourself project. They not only make your life simpler, they also bring about a lifetime of satisfaction. The Closets To Go closet organizers are the easiest to design and assemble. From our easy-to-adjust hanging bracket to the pre-assembly of all your hardware fittings and labeled panels, we've virtually made reading instructions a thing of the past. Our custom closet organizers are the easiest to install in the nation, guaranteed! They're also constructed with high-quality, environmentally-friendly materials made right here in the United States.</p>

<div class="folder-wrapper__specification-sheet--wrapper-image-wrap">
<figure class="folder-wrapper__specification-sheet--wrapper-image-box">
<img src="<?php echo SITEROOT; ?>images/idea-folder-room-5.png" alt="" class="folder-wrapper__specification-sheet--wrapper-image-img img-fluid">

<figcaption class="folder-wrapper__specification-sheet--wrapper-image-content">
<div class="folder-wrapper__specification-sheet--wrapper-image-buttons">
<button class="shere">
<svg xmlns="http://www.w3.org/2000/svg" width="23.547" height="25.688" viewBox="0 0 23.547 25.688"><defs><style>.share-white{fill:#fff;}</style></defs><g transform="translate(0)"><path class="share-white" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"/><path class="share-white" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"/><path class="share-white" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"/><path class="share-white" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"/><path class="share-white" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"/><path class="share-white" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"/><path class="share-white" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"/><path class="share-white" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"/></g></svg>
</button>
<button class="delete" data-toggle="modal" data-target="#deleteFolder">
<svg xmlns="http://www.w3.org/2000/svg" width="14.932" height="16.033" viewBox="0 0 14.932 16.033"><defs><style>.trash-white{fill:#fff;}</style></defs><g transform="translate(0 0)"><g transform="translate(0 0)"><g transform="translate(0 0)"><path class="trash-white" d="M63.331,124.769a1.305,1.305,0,0,0,1.351,1.168h5.771a1.328,1.328,0,0,0,1.374-1.191l.939-9.8H62.186Z" transform="translate(-60.01 -109.905)"/><path class="trash-white" d="M27.028,2.061h-4.26V1.328A1.283,1.283,0,0,0,21.533,0H18.577a1.282,1.282,0,0,0-1.306,1.259q0,.035,0,.07v.733h-4.26a.458.458,0,0,0,0,.916H27.028a.458.458,0,1,0,0-.916Zm-5.176-.733v.733H18.188V1.328a.366.366,0,0,1,.389-.412h2.886a.366.366,0,0,1,.391.34A.362.362,0,0,1,21.852,1.328Z" transform="translate(-12.554 0)"/></g></g></g></svg>
</button>
</div>
<p class="folder-wrapper__specification-sheet--wrapper-image-text">Go to product details</p>
</figcaption>
</figure>

<figure class="folder-wrapper__specification-sheet--wrapper-image-box">
<img src="<?php echo SITEROOT; ?>images/idea-folder-room-2.png" alt="" class="folder-wrapper__specification-sheet--wrapper-image-img img-fluid">

<figcaption class="folder-wrapper__specification-sheet--wrapper-image-content">
<div class="folder-wrapper__specification-sheet--wrapper-image-buttons">
<button class="shere">
<svg xmlns="http://www.w3.org/2000/svg" width="23.547" height="25.688" viewBox="0 0 23.547 25.688"><defs><style>.share-white{fill:#fff;}</style></defs><g transform="translate(0)"><path class="share-white" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"/><path class="share-white" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"/><path class="share-white" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"/><path class="share-white" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"/><path class="share-white" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"/><path class="share-white" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"/><path class="share-white" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"/><path class="share-white" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"/></g></svg>
</button>
<button class="delete" data-toggle="modal" data-target="#deleteFolder">
<svg xmlns="http://www.w3.org/2000/svg" width="14.932" height="16.033" viewBox="0 0 14.932 16.033"><defs><style>.trash-white{fill:#fff;}</style></defs><g transform="translate(0 0)"><g transform="translate(0 0)"><g transform="translate(0 0)"><path class="trash-white" d="M63.331,124.769a1.305,1.305,0,0,0,1.351,1.168h5.771a1.328,1.328,0,0,0,1.374-1.191l.939-9.8H62.186Z" transform="translate(-60.01 -109.905)"/><path class="trash-white" d="M27.028,2.061h-4.26V1.328A1.283,1.283,0,0,0,21.533,0H18.577a1.282,1.282,0,0,0-1.306,1.259q0,.035,0,.07v.733h-4.26a.458.458,0,0,0,0,.916H27.028a.458.458,0,1,0,0-.916Zm-5.176-.733v.733H18.188V1.328a.366.366,0,0,1,.389-.412h2.886a.366.366,0,0,1,.391.34A.362.362,0,0,1,21.852,1.328Z" transform="translate(-12.554 0)"/></g></g></g></svg>
</button>
</div>
<p class="folder-wrapper__specification-sheet--wrapper-image-text">Go to product details</p>
</figcaption>
</figure>

<figure class="folder-wrapper__specification-sheet--wrapper-image-box">
<img src="<?php echo SITEROOT; ?>images/idea-folder-room-3.png" alt="" class="folder-wrapper__specification-sheet--wrapper-image-img img-fluid">

<figcaption class="folder-wrapper__specification-sheet--wrapper-image-content">
<div class="folder-wrapper__specification-sheet--wrapper-image-buttons">
<button class="shere">
<svg xmlns="http://www.w3.org/2000/svg" width="23.547" height="25.688" viewBox="0 0 23.547 25.688"><defs><style>.share-white{fill:#fff;}</style></defs><g transform="translate(0)"><path class="share-white" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"/><path class="share-white" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"/><path class="share-white" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"/><path class="share-white" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"/><path class="share-white" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"/><path class="share-white" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"/><path class="share-white" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"/><path class="share-white" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"/></g></svg>
</button>
<button class="delete" data-toggle="modal" data-target="#deleteFolder">
<svg xmlns="http://www.w3.org/2000/svg" width="14.932" height="16.033" viewBox="0 0 14.932 16.033"><defs><style>.trash-white{fill:#fff;}</style></defs><g transform="translate(0 0)"><g transform="translate(0 0)"><g transform="translate(0 0)"><path class="trash-white" d="M63.331,124.769a1.305,1.305,0,0,0,1.351,1.168h5.771a1.328,1.328,0,0,0,1.374-1.191l.939-9.8H62.186Z" transform="translate(-60.01 -109.905)"/><path class="trash-white" d="M27.028,2.061h-4.26V1.328A1.283,1.283,0,0,0,21.533,0H18.577a1.282,1.282,0,0,0-1.306,1.259q0,.035,0,.07v.733h-4.26a.458.458,0,0,0,0,.916H27.028a.458.458,0,1,0,0-.916Zm-5.176-.733v.733H18.188V1.328a.366.366,0,0,1,.389-.412h2.886a.366.366,0,0,1,.391.34A.362.362,0,0,1,21.852,1.328Z" transform="translate(-12.554 0)"/></g></g></g></svg>
</button>
</div>
<p class="folder-wrapper__specification-sheet--wrapper-image-text">Go to product details</p>
</figcaption>
</figure>

<figure class="folder-wrapper__specification-sheet--wrapper-image-box">
<img src="<?php echo SITEROOT; ?>images/idea-folder-room-4.png" alt="" class="folder-wrapper__specification-sheet--wrapper-image-img img-fluid">

<figcaption class="folder-wrapper__specification-sheet--wrapper-image-content">
<div class="folder-wrapper__specification-sheet--wrapper-image-buttons">
<button class="shere">
<svg xmlns="http://www.w3.org/2000/svg" width="23.547" height="25.688" viewBox="0 0 23.547 25.688"><defs><style>.share-white{fill:#fff;}</style></defs><g transform="translate(0)"><path class="share-white" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"/><path class="share-white" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"/><path class="share-white" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"/><path class="share-white" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"/><path class="share-white" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"/><path class="share-white" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"/><path class="share-white" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"/><path class="share-white" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"/></g></svg>
</button>
<button class="delete" data-toggle="modal" data-target="#deleteFolder">
<svg xmlns="http://www.w3.org/2000/svg" width="14.932" height="16.033" viewBox="0 0 14.932 16.033"><defs><style>.trash-white{fill:#fff;}</style></defs><g transform="translate(0 0)"><g transform="translate(0 0)"><g transform="translate(0 0)"><path class="trash-white" d="M63.331,124.769a1.305,1.305,0,0,0,1.351,1.168h5.771a1.328,1.328,0,0,0,1.374-1.191l.939-9.8H62.186Z" transform="translate(-60.01 -109.905)"/><path class="trash-white" d="M27.028,2.061h-4.26V1.328A1.283,1.283,0,0,0,21.533,0H18.577a1.282,1.282,0,0,0-1.306,1.259q0,.035,0,.07v.733h-4.26a.458.458,0,0,0,0,.916H27.028a.458.458,0,1,0,0-.916Zm-5.176-.733v.733H18.188V1.328a.366.366,0,0,1,.389-.412h2.886a.366.366,0,0,1,.391.34A.362.362,0,0,1,21.852,1.328Z" transform="translate(-12.554 0)"/></g></g></g></svg>
</button>
</div>
<p class="folder-wrapper__specification-sheet--wrapper-image-text">Go to product details</p>
</figcaption>
</figure>
</div>
</div>

<div class="folder-wrapper__specification-sheet--buttons-box">

<div class="folder-wrapper__specification-sheet--buttons-box-content">
<span class="folder-wrapper__specification-sheet--buttons-box-image">
<svg xmlns="http://www.w3.org/2000/svg" width="24.704" height="16.27" viewBox="0 0 24.704 16.27">
<g id="open-folder-black-and-white-variant" transform="translate(0 -87.578)">
<path id="Path_434" data-name="Path 434" d="M18.618,102.844a1.7,1.7,0,0,0,1.429-.84l4.57-8.648c.273-.526-.124-.84-.84-.84H19.163V90.451a1.3,1.3,0,0,0-1.293-1.293H6.573l-.838-2.2a.59.59,0,0,0-.551-.38H.6a.589.589,0,0,0-.59.593l.011,3.28L0,101.554a1.3,1.3,0,0,0,1.293,1.293m16.69-10.33H7.922a1.392,1.392,0,0,0-1.134.84l-4.109,8.311H1.293a.114.114,0,0,1-.114-.114v-13.8h3.6l.838,2.2a.59.59,0,0,0,.551.38h11.7a.114.114,0,0,1,.114.114v2.066Z" transform="translate(0 1)" fill="#fff"/>
</g>
</svg>
</span>

<button class="folder-wrapper__specification-sheet--button js-hide-specification-sheet-box-btn">
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 495.785 495.785" xml:space="preserve"><path id="XMLID_26_" d="M436.855,90.337L255.175,0.541c-1.62-0.801-3.533-0.707-5.084,0.249c-1.535,0.957-2.467,2.638-2.467,4.449  v36.834H56.017v453.713h105.924V147.996h85.684v36.833c0,1.812,0.932,3.492,2.467,4.449c1.551,0.956,3.464,1.052,5.084,0.249  l181.68-89.796c1.791-0.888,2.914-2.706,2.914-4.698C439.769,93.043,438.646,91.225,436.855,90.337z"/><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
../ Specification sheet
</button>
</div>

<button class="folder-wrapper__specification-sheet--button second-fixed-button js-to-top">
Top
</button>

<button class="folder-wrapper__specification-sheet--button second-button js-hide-specification-sheet-box-btn">
Back
</button>
</div>
</div>
</div>

<div class="col-12 js-add-to-rooms-new-idea-folder-images" style="display: none;">
<div class="new-idea-folder-images__wrapper">

<div class="new-idea-folder-images__buttons">

<div class="new-idea-folder-images__buttons-box-content">
<span class="new-idea-folder-images__buttons-box-image">
<svg xmlns="http://www.w3.org/2000/svg" width="24.704" height="16.27" viewBox="0 0 24.704 16.27">
<g id="open-folder-black-and-white-variant" transform="translate(0 -87.578)">
<path id="Path_434" data-name="Path 434" d="M18.618,102.844a1.7,1.7,0,0,0,1.429-.84l4.57-8.648c.273-.526-.124-.84-.84-.84H19.163V90.451a1.3,1.3,0,0,0-1.293-1.293H6.573l-.838-2.2a.59.59,0,0,0-.551-.38H.6a.589.589,0,0,0-.59.593l.011,3.28L0,101.554a1.3,1.3,0,0,0,1.293,1.293m16.69-10.33H7.922a1.392,1.392,0,0,0-1.134.84l-4.109,8.311H1.293a.114.114,0,0,1-.114-.114v-13.8h3.6l.838,2.2a.59.59,0,0,0,.551.38h11.7a.114.114,0,0,1,.114.114v2.066Z" transform="translate(0 1)" fill="#fff"></path>
</g>
</svg>
</span>

<button class="new-idea-folder-images__button first-button js-hide-add-to-rooms-new-idea-folder-images-btn">
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 495.785 495.785" xml:space="preserve"><path id="XMLID_26_" d="M436.855,90.337L255.175,0.541c-1.62-0.801-3.533-0.707-5.084,0.249c-1.535,0.957-2.467,2.638-2.467,4.449  v36.834H56.017v453.713h105.924V147.996h85.684v36.833c0,1.812,0.932,3.492,2.467,4.449c1.551,0.956,3.464,1.052,5.084,0.249  l181.68-89.796c1.791-0.888,2.914-2.706,2.914-4.698C439.769,93.043,438.646,91.225,436.855,90.337z"></path><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
../ Nice things for glob...
</button>
</div>

<button class="new-idea-folder-images__button back-btn js-hide-add-to-rooms-new-idea-folder-images-btn">
Back
</button>
</div>

<div class="folder-wrapper__saved-elements">
<figure class="folder-wrapper__saved-element add-new-button js-url-modal-btn" data-tab-parrent="#v-pills-bathroom" data-button-positon="folder-name" data-toggle="modal" data-target="#newImageUrl">
<figcaption class="add-new-button__wrap">

<span class="svg-group">
<span class="svg-group__first">
<svg xmlns="http://www.w3.org/2000/svg" width="34.215" height="51.323" viewBox="0 0 34.215 51.323">
<path id="Path_451" data-name="Path 451" d="M161.684,17.839,146.714.731a2.134,2.134,0,0,0-3.216,0L128.529,17.839a2.137,2.137,0,0,0,1.608,3.546h8.554v27.8a2.139,2.139,0,0,0,2.138,2.138h8.554a2.139,2.139,0,0,0,2.138-2.138v-27.8h8.554a2.137,2.137,0,0,0,1.608-3.546Z" transform="translate(-127.998)" fill="#fff"/>
</svg>
</span>
<span class="svg-group__second">
<svg xmlns="http://www.w3.org/2000/svg" width="21.992" height="9.797" viewBox="0 0 21.992 9.797">
<path id="Path_448" data-name="Path 448" d="M20.286,207.506a1.764,1.764,0,0,0-1.764,1.764v4.5H3.586v-4.5a1.764,1.764,0,0,0-3.528,0v6.269A1.764,1.764,0,0,0,1.822,217.3H20.286a1.764,1.764,0,0,0,1.764-1.764V209.27A1.764,1.764,0,0,0,20.286,207.506Z" transform="translate(-0.058 -207.506)" fill="#fff"/>
</svg>
</span>
</span>

<p class="folder-wrapper__saved-element--folders-text">Add an external URL of image or upload an image from the device</p>
</figcaption>
</figure>
<figure class="folder-wrapper__saved-element">
<img src="<?php echo SITEROOT; ?>images/idea-folder-room-2.png" alt="" class="folder-wrapper__saved-element--img img-fluid">
<figcaption class="folder-wrapper__saved-element--text-box">
<div class="folder-wrapper__saved-element--buttons">
<button class="shere">
<svg xmlns="http://www.w3.org/2000/svg" width="23.547" height="25.688" viewBox="0 0 23.547 25.688"><defs><style>.share-white{fill:#fff;}</style></defs><g transform="translate(0)"><path class="share-white" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"/><path class="share-white" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"/><path class="share-white" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"/><path class="share-white" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"/><path class="share-white" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"/><path class="share-white" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"/><path class="share-white" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"/><path class="share-white" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"/></g></svg>
</button>
<button class="delete" data-toggle="modal" data-target="#deleteFolder">
<svg xmlns="http://www.w3.org/2000/svg" width="14.932" height="16.033" viewBox="0 0 14.932 16.033"><defs><style>.trash-white{fill:#fff;}</style></defs><g transform="translate(0 0)"><g transform="translate(0 0)"><g transform="translate(0 0)"><path class="trash-white" d="M63.331,124.769a1.305,1.305,0,0,0,1.351,1.168h5.771a1.328,1.328,0,0,0,1.374-1.191l.939-9.8H62.186Z" transform="translate(-60.01 -109.905)"/><path class="trash-white" d="M27.028,2.061h-4.26V1.328A1.283,1.283,0,0,0,21.533,0H18.577a1.282,1.282,0,0,0-1.306,1.259q0,.035,0,.07v.733h-4.26a.458.458,0,0,0,0,.916H27.028a.458.458,0,1,0,0-.916Zm-5.176-.733v.733H18.188V1.328a.366.366,0,0,1,.389-.412h2.886a.366.366,0,0,1,.391.34A.362.362,0,0,1,21.852,1.328Z" transform="translate(-12.554 0)"/></g></g></g></svg>
</button>
</div>
<div class="idea-folder-gallery">
<a href="images/idea-folder-room-2.png" title="Lorem ipsum" class="folder-wrapper__saved-element--text">
Preview
</a>
</div>
</figcaption>
</figure>
<figure class="folder-wrapper__saved-element">
<img src="<?php echo SITEROOT; ?>images/idea-folder-room-3.png" alt="" class="folder-wrapper__saved-element--img img-fluid">
<figcaption class="folder-wrapper__saved-element--text-box">
<div class="folder-wrapper__saved-element--buttons">
<button class="shere">
<svg xmlns="http://www.w3.org/2000/svg" width="23.547" height="25.688" viewBox="0 0 23.547 25.688"><defs><style>.share-white{fill:#fff;}</style></defs><g transform="translate(0)"><path class="share-white" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"/><path class="share-white" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"/><path class="share-white" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"/><path class="share-white" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"/><path class="share-white" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"/><path class="share-white" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"/><path class="share-white" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"/><path class="share-white" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"/></g></svg>
</button>
<button class="delete" data-toggle="modal" data-target="#deleteFolder">
<svg xmlns="http://www.w3.org/2000/svg" width="14.932" height="16.033" viewBox="0 0 14.932 16.033"><defs><style>.trash-white{fill:#fff;}</style></defs><g transform="translate(0 0)"><g transform="translate(0 0)"><g transform="translate(0 0)"><path class="trash-white" d="M63.331,124.769a1.305,1.305,0,0,0,1.351,1.168h5.771a1.328,1.328,0,0,0,1.374-1.191l.939-9.8H62.186Z" transform="translate(-60.01 -109.905)"/><path class="trash-white" d="M27.028,2.061h-4.26V1.328A1.283,1.283,0,0,0,21.533,0H18.577a1.282,1.282,0,0,0-1.306,1.259q0,.035,0,.07v.733h-4.26a.458.458,0,0,0,0,.916H27.028a.458.458,0,1,0,0-.916Zm-5.176-.733v.733H18.188V1.328a.366.366,0,0,1,.389-.412h2.886a.366.366,0,0,1,.391.34A.362.362,0,0,1,21.852,1.328Z" transform="translate(-12.554 0)"/></g></g></g></svg>
</button>
</div>
<div class="idea-folder-gallery">
<a href="images/idea-folder-room-3.png" title="Lorem ipsum" class="folder-wrapper__saved-element--text">
Preview
</a>
</div>
</figcaption>
</figure>
<figure class="folder-wrapper__saved-element">
<img src="<?php echo SITEROOT; ?>images/idea-folder-room-4.png" alt="" class="folder-wrapper__saved-element--img img-fluid">
<figcaption class="folder-wrapper__saved-element--text-box">
<div class="folder-wrapper__saved-element--buttons">
<button class="shere">
<svg xmlns="http://www.w3.org/2000/svg" width="23.547" height="25.688" viewBox="0 0 23.547 25.688"><defs><style>.share-white{fill:#fff;}</style></defs><g transform="translate(0)"><path class="share-white" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"/><path class="share-white" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"/><path class="share-white" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"/><path class="share-white" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"/><path class="share-white" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"/><path class="share-white" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"/><path class="share-white" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"/><path class="share-white" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"/></g></svg>
</button>
<button class="delete" data-toggle="modal" data-target="#deleteFolder">
<svg xmlns="http://www.w3.org/2000/svg" width="14.932" height="16.033" viewBox="0 0 14.932 16.033"><defs><style>.trash-white{fill:#fff;}</style></defs><g transform="translate(0 0)"><g transform="translate(0 0)"><g transform="translate(0 0)"><path class="trash-white" d="M63.331,124.769a1.305,1.305,0,0,0,1.351,1.168h5.771a1.328,1.328,0,0,0,1.374-1.191l.939-9.8H62.186Z" transform="translate(-60.01 -109.905)"/><path class="trash-white" d="M27.028,2.061h-4.26V1.328A1.283,1.283,0,0,0,21.533,0H18.577a1.282,1.282,0,0,0-1.306,1.259q0,.035,0,.07v.733h-4.26a.458.458,0,0,0,0,.916H27.028a.458.458,0,1,0,0-.916Zm-5.176-.733v.733H18.188V1.328a.366.366,0,0,1,.389-.412h2.886a.366.366,0,0,1,.391.34A.362.362,0,0,1,21.852,1.328Z" transform="translate(-12.554 0)"/></g></g></g></svg>
</button>
</div>
<div class="idea-folder-gallery">
<a href="images/idea-folder-room-4.png" title="Lorem ipsum" class="folder-wrapper__saved-element--text">
Preview
</a>
</div>
</figcaption>
</figure>
<figure class="folder-wrapper__saved-element">
<img src="<?php echo SITEROOT; ?>images/idea-folder-room-5.png" alt="" class="folder-wrapper__saved-element--img img-fluid">
<figcaption class="folder-wrapper__saved-element--text-box">
<div class="folder-wrapper__saved-element--buttons">
<button class="shere">
<svg xmlns="http://www.w3.org/2000/svg" width="23.547" height="25.688" viewBox="0 0 23.547 25.688"><defs><style>.share-white{fill:#fff;}</style></defs><g transform="translate(0)"><path class="share-white" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"/><path class="share-white" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"/><path class="share-white" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"/><path class="share-white" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"/><path class="share-white" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"/><path class="share-white" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"/><path class="share-white" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"/><path class="share-white" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"/></g></svg>
</button>
<button class="delete" data-toggle="modal" data-target="#deleteFolder">
<svg xmlns="http://www.w3.org/2000/svg" width="14.932" height="16.033" viewBox="0 0 14.932 16.033"><defs><style>.trash-white{fill:#fff;}</style></defs><g transform="translate(0 0)"><g transform="translate(0 0)"><g transform="translate(0 0)"><path class="trash-white" d="M63.331,124.769a1.305,1.305,0,0,0,1.351,1.168h5.771a1.328,1.328,0,0,0,1.374-1.191l.939-9.8H62.186Z" transform="translate(-60.01 -109.905)"/><path class="trash-white" d="M27.028,2.061h-4.26V1.328A1.283,1.283,0,0,0,21.533,0H18.577a1.282,1.282,0,0,0-1.306,1.259q0,.035,0,.07v.733h-4.26a.458.458,0,0,0,0,.916H27.028a.458.458,0,1,0,0-.916Zm-5.176-.733v.733H18.188V1.328a.366.366,0,0,1,.389-.412h2.886a.366.366,0,0,1,.391.34A.362.362,0,0,1,21.852,1.328Z" transform="translate(-12.554 0)"/></g></g></g></svg>
</button>
</div>
<div class="idea-folder-gallery">
<a href="images/idea-folder-room-5.png" title="Lorem ipsum" class="folder-wrapper__saved-element--text">
Preview
</a>
</div>
</figcaption>
</figure>
</div>
</div>
</div>
</div>
</div>
</div>


<div class="tab-pane fade" id="v-pills-game-room" role="tabpanel" aria-labelledby="v-pills-game-room-tab">
<div class="folder-wrapper">
<div class="desktop-show">
<div class="row mb-2">
<div class="col-8">
<h3 class="folder-wrapper__heading">Title house name 1 - Game Room</h3>
</div>
</div>
</div>
<div class="row">
<div class="col-12 js-saved-images-box">
<div class="new-idea-folder-images__wrapper">
<div class="new-idea-folder-images__buttons">

<p class="new-idea-folder-images__empty-text">
No saved files in Game Room!
</p>
</div>

<div class="mb-2">
<p class="idea-folder-empty-house__text">You can add them from our website or by adding external images by choosing the option below</p>
</div>

<div class="folder-wrapper__saved-elements">
<figure class="folder-wrapper__saved-element specification-sheet">
<figcaption class="folder-wrapper__saved-element--folders">
<span class="folder-wrapper__saved-element--folders-img">
<svg xmlns="http://www.w3.org/2000/svg" width="24.704" height="16.27" viewBox="0 0 24.704 16.27">
<g id="open-folder-black-and-white-variant" transform="translate(0 -87.578)">
<path id="Path_434" data-name="Path 434" d="M18.618,102.844a1.7,1.7,0,0,0,1.429-.84l4.57-8.648c.273-.526-.124-.84-.84-.84H19.163V90.451a1.3,1.3,0,0,0-1.293-1.293H6.573l-.838-2.2a.59.59,0,0,0-.551-.38H.6a.589.589,0,0,0-.59.593l.011,3.28L0,101.554a1.3,1.3,0,0,0,1.293,1.293m16.69-10.33H7.922a1.392,1.392,0,0,0-1.134.84l-4.109,8.311H1.293a.114.114,0,0,1-.114-.114v-13.8h3.6l.838,2.2a.59.59,0,0,0,.551.38h11.7a.114.114,0,0,1,.114.114v2.066Z" transform="translate(0 1)" fill="#fff"/>
</g>
</svg>
</span>
<div class="folder-wrapper__saved-element--buttons">
<button class="shere">
<svg xmlns="http://www.w3.org/2000/svg" width="23.547" height="25.688" viewBox="0 0 23.547 25.688"><defs><style>.share-white{fill:#fff;}</style></defs><g transform="translate(0)"><path class="share-white" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"/><path class="share-white" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"/><path class="share-white" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"/><path class="share-white" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"/><path class="share-white" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"/><path class="share-white" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"/><path class="share-white" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"/><path class="share-white" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"/></g></svg>
</button>
<button class="delete" data-toggle="modal" data-target="#deleteFolder">
<svg xmlns="http://www.w3.org/2000/svg" width="14.932" height="16.033" viewBox="0 0 14.932 16.033"><defs><style>.trash-white{fill:#fff;}</style></defs><g transform="translate(0 0)"><g transform="translate(0 0)"><g transform="translate(0 0)"><path class="trash-white" d="M63.331,124.769a1.305,1.305,0,0,0,1.351,1.168h5.771a1.328,1.328,0,0,0,1.374-1.191l.939-9.8H62.186Z" transform="translate(-60.01 -109.905)"/><path class="trash-white" d="M27.028,2.061h-4.26V1.328A1.283,1.283,0,0,0,21.533,0H18.577a1.282,1.282,0,0,0-1.306,1.259q0,.035,0,.07v.733h-4.26a.458.458,0,0,0,0,.916H27.028a.458.458,0,1,0,0-.916Zm-5.176-.733v.733H18.188V1.328a.366.366,0,0,1,.389-.412h2.886a.366.366,0,0,1,.391.34A.362.362,0,0,1,21.852,1.328Z" transform="translate(-12.554 0)"/></g></g></g></svg>
</button>
</div>
<p class="folder-wrapper__saved-element--text first">Specification sheet</p>
<button class="folder-wrapper__saved-element--folders-button"><span onClick="open_specs();">open folder</span></button>
</figcaption>
</figure>
<figure class="folder-wrapper__saved-element folders">
<figcaption class="folder-wrapper__saved-element--folders">
<span class="folder-wrapper__saved-element--folders-img">
<svg xmlns="http://www.w3.org/2000/svg" width="86" height="71.044" viewBox="0 0 86 71.044"><defs><style>.folder-orange{fill:#edb700;}</style></defs><g transform="translate(-10.667)"><g transform="translate(10.667 7.478)"><g transform="translate(0)"><path class="folder-orange" d="M87.319,53.884H44.1a5.6,5.6,0,0,1-5.321-3.836l-.329-.991a9.337,9.337,0,0,0-8.865-6.39H20.015a9.361,9.361,0,0,0-9.348,9.348v44.87a9.358,9.358,0,0,0,9.348,9.348H34.971a1.87,1.87,0,1,0,0-3.739H20.015a5.615,5.615,0,0,1-5.609-5.609V52.015a5.615,5.615,0,0,1,5.609-5.609h9.568A5.6,5.6,0,0,1,34.9,50.239l.333.995a9.337,9.337,0,0,0,8.865,6.39H87.319a5.615,5.615,0,0,1,5.609,5.609V96.884a5.615,5.615,0,0,1-5.609,5.609H72.363a1.87,1.87,0,0,0,0,3.739H87.319a9.356,9.356,0,0,0,9.348-9.348V63.232A9.358,9.358,0,0,0,87.319,53.884Z" transform="translate(-10.667 -42.667)"/></g></g><g transform="translate(14.406)"><path class="folder-orange" d="M101.174,0H41.348A9.361,9.361,0,0,0,32,9.348a1.87,1.87,0,0,0,3.739,0,5.615,5.615,0,0,1,5.609-5.609h59.826a5.615,5.615,0,0,1,5.609,5.609V20.565a1.87,1.87,0,1,0,3.739,0V9.348A9.359,9.359,0,0,0,101.174,0Z" transform="translate(-32)"/></g></g></svg>
</span>
<p class="folder-wrapper__saved-element--folders-text">Nice things for living room</p>
<button class="folder-wrapper__saved-element--folders-button js-show-add-to-rooms-new-idea-folder-images-btn">View folder</button>
</figcaption>
</figure>
<figure class="folder-wrapper__saved-element add-new-button js-url-modal-btn" data-tab-parrent="#v-pills-game-room" data-button-positon="room-name" data-toggle="modal" data-target="#newImageUrl">
<figcaption class="add-new-button__wrap">

<span class="svg-group">
<span class="svg-group__first">
<svg xmlns="http://www.w3.org/2000/svg" width="34.215" height="51.323" viewBox="0 0 34.215 51.323">
<path id="Path_451" data-name="Path 451" d="M161.684,17.839,146.714.731a2.134,2.134,0,0,0-3.216,0L128.529,17.839a2.137,2.137,0,0,0,1.608,3.546h8.554v27.8a2.139,2.139,0,0,0,2.138,2.138h8.554a2.139,2.139,0,0,0,2.138-2.138v-27.8h8.554a2.137,2.137,0,0,0,1.608-3.546Z" transform="translate(-127.998)" fill="#fff"/>
</svg>
</span>
<span class="svg-group__second">
<svg xmlns="http://www.w3.org/2000/svg" width="21.992" height="9.797" viewBox="0 0 21.992 9.797">
<path id="Path_448" data-name="Path 448" d="M20.286,207.506a1.764,1.764,0,0,0-1.764,1.764v4.5H3.586v-4.5a1.764,1.764,0,0,0-3.528,0v6.269A1.764,1.764,0,0,0,1.822,217.3H20.286a1.764,1.764,0,0,0,1.764-1.764V209.27A1.764,1.764,0,0,0,20.286,207.506Z" transform="translate(-0.058 -207.506)" fill="#fff"/>
</svg>
</span>
</span>

<p class="folder-wrapper__saved-element--folders-text">Add an external URL of image or upload an image from the device</p>
</figcaption>
</figure>
</div>
</div>
</div>

<div class="col-12 js-specification-sheet-box" style="display: none;">
<div class="folder-wrapper__specification-sheet--wrapper">

<div class="folder-wrapper__specification-sheet--buttons-box">

<div class="folder-wrapper__specification-sheet--buttons-box-content">
<span class="folder-wrapper__specification-sheet--buttons-box-image">
<svg xmlns="http://www.w3.org/2000/svg" width="24.704" height="16.27" viewBox="0 0 24.704 16.27">
<g id="open-folder-black-and-white-variant" transform="translate(0 -87.578)">
<path id="Path_434" data-name="Path 434" d="M18.618,102.844a1.7,1.7,0,0,0,1.429-.84l4.57-8.648c.273-.526-.124-.84-.84-.84H19.163V90.451a1.3,1.3,0,0,0-1.293-1.293H6.573l-.838-2.2a.59.59,0,0,0-.551-.38H.6a.589.589,0,0,0-.59.593l.011,3.28L0,101.554a1.3,1.3,0,0,0,1.293,1.293m16.69-10.33H7.922a1.392,1.392,0,0,0-1.134.84l-4.109,8.311H1.293a.114.114,0,0,1-.114-.114v-13.8h3.6l.838,2.2a.59.59,0,0,0,.551.38h11.7a.114.114,0,0,1,.114.114v2.066Z" transform="translate(0 1)" fill="#fff"/>
</g>
</svg>
</span>

<button class="folder-wrapper__specification-sheet--button js-hide-specification-sheet-box-btn">
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 495.785 495.785" xml:space="preserve"><path id="XMLID_26_" d="M436.855,90.337L255.175,0.541c-1.62-0.801-3.533-0.707-5.084,0.249c-1.535,0.957-2.467,2.638-2.467,4.449  v36.834H56.017v453.713h105.924V147.996h85.684v36.833c0,1.812,0.932,3.492,2.467,4.449c1.551,0.956,3.464,1.052,5.084,0.249  l181.68-89.796c1.791-0.888,2.914-2.706,2.914-4.698C439.769,93.043,438.646,91.225,436.855,90.337z"/><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
../ Specification sheet
</button>
</div>

<div class="d-flex justify-content-center align-items-center">
<div class="house-checkbox">
<input class="custom-checkbox js-load-confirm-modal" id="checkbox-10" type="checkbox" value="value10" data-target="#confirmModal">
<label for="checkbox-10">Share with Closets To Go</label>
</div>

<button class="folder-wrapper__specification-sheet--button second-button js-hide-specification-sheet-box-btn">
Back
</button>
</div>
</div>

<div class="mt-2 mb-2">
<p class="idea-folder-empty-house__heading">No saved files in 'Nice things for Guest Room folder!</p>
<p class="idea-folder-empty-house__text">You can add them from our website or by adding external images by choosing the option below</p>
</div>

</div>
</div>

<div class="col-12 js-add-to-rooms-new-idea-folder-images" style="display: none;">
<div class="new-idea-folder-images__wrapper">

<div class="new-idea-folder-images__buttons">

<div class="new-idea-folder-images__buttons-box-content">
<span class="new-idea-folder-images__buttons-box-image">
<svg xmlns="http://www.w3.org/2000/svg" width="24.704" height="16.27" viewBox="0 0 24.704 16.27">
<g id="open-folder-black-and-white-variant" transform="translate(0 -87.578)">
<path id="Path_434" data-name="Path 434" d="M18.618,102.844a1.7,1.7,0,0,0,1.429-.84l4.57-8.648c.273-.526-.124-.84-.84-.84H19.163V90.451a1.3,1.3,0,0,0-1.293-1.293H6.573l-.838-2.2a.59.59,0,0,0-.551-.38H.6a.589.589,0,0,0-.59.593l.011,3.28L0,101.554a1.3,1.3,0,0,0,1.293,1.293m16.69-10.33H7.922a1.392,1.392,0,0,0-1.134.84l-4.109,8.311H1.293a.114.114,0,0,1-.114-.114v-13.8h3.6l.838,2.2a.59.59,0,0,0,.551.38h11.7a.114.114,0,0,1,.114.114v2.066Z" transform="translate(0 1)" fill="#fff"></path>
</g>
</svg>
</span>

<button class="new-idea-folder-images__button first-button js-hide-add-to-rooms-new-idea-folder-images-btn">
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 495.785 495.785" xml:space="preserve"><path id="XMLID_26_" d="M436.855,90.337L255.175,0.541c-1.62-0.801-3.533-0.707-5.084,0.249c-1.535,0.957-2.467,2.638-2.467,4.449  v36.834H56.017v453.713h105.924V147.996h85.684v36.833c0,1.812,0.932,3.492,2.467,4.449c1.551,0.956,3.464,1.052,5.084,0.249  l181.68-89.796c1.791-0.888,2.914-2.706,2.914-4.698C439.769,93.043,438.646,91.225,436.855,90.337z"></path><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
../ Nice things for glob...
</button>
</div>

<button class="new-idea-folder-images__button back-btn js-hide-add-to-rooms-new-idea-folder-images-btn">
Back
</button>
</div>

<div class="mt-2 mb-2">
<p class="idea-folder-empty-house__heading">No saved files in 'Nice things for Guest Room folder!</p>
<p class="idea-folder-empty-house__text">You can add them from our website or by adding external images by choosing the option below</p>
</div>

<div class="folder-wrapper__saved-elements">
<figure class="folder-wrapper__saved-element add-new-button js-url-modal-btn" data-tab-parrent="#v-pills-game-room" data-button-positon="folder-name" data-toggle="modal" data-target="#newImageUrl">
<figcaption class="add-new-button__wrap">
<span class="svg-group">
<span class="svg-group__first">
<svg xmlns="http://www.w3.org/2000/svg" width="34.215" height="51.323" viewBox="0 0 34.215 51.323">
<path id="Path_451" data-name="Path 451" d="M161.684,17.839,146.714.731a2.134,2.134,0,0,0-3.216,0L128.529,17.839a2.137,2.137,0,0,0,1.608,3.546h8.554v27.8a2.139,2.139,0,0,0,2.138,2.138h8.554a2.139,2.139,0,0,0,2.138-2.138v-27.8h8.554a2.137,2.137,0,0,0,1.608-3.546Z" transform="translate(-127.998)" fill="#fff"/>
</svg>
</span>
<span class="svg-group__second">
<svg xmlns="http://www.w3.org/2000/svg" width="21.992" height="9.797" viewBox="0 0 21.992 9.797">
<path id="Path_448" data-name="Path 448" d="M20.286,207.506a1.764,1.764,0,0,0-1.764,1.764v4.5H3.586v-4.5a1.764,1.764,0,0,0-3.528,0v6.269A1.764,1.764,0,0,0,1.822,217.3H20.286a1.764,1.764,0,0,0,1.764-1.764V209.27A1.764,1.764,0,0,0,20.286,207.506Z" transform="translate(-0.058 -207.506)" fill="#fff"/>
</svg>
</span>
</span>

<p class="folder-wrapper__saved-element--folders-text">Add an external URL of image or upload an image from the device</p>
</figcaption>
</figure>
</div>
</div>
</div>
</div>
</div>
</div>


<div class="tab-pane fade" id="v-pills-basement" role="tabpanel" aria-labelledby="v-pills-basement-tab">
<div class="folder-wrapper">
<div class="desktop-show">
<div class="row mb-2">
<div class="col-8">
<h3 class="folder-wrapper__heading">Title house name 1 - Basement</h3>
</div>
<div class="col-4">
<p class="folder-wrapper__all-items">
<span class="folder-wrapper__all-items--img">5</span> images / 
<span class="folder-wrapper__all-items--subfolders">1</span> subfolder
</p>
</div>
</div>
<div class="row mb-4">
<div class="col-6 d-flex align-items-center">
<button class="folder-wrapper__specification-sheet-top-btn js-show-specification-sheet-btn">
<span></span>
Specification sheet
</button>
<button class="folder-wrapper__info" data-toggle="modal" data-target="#specificationsSheetInfo">
<svg xmlns="http://www.w3.org/2000/svg" width="17.667" height="17.667" viewBox="0 0 17.667 17.667">
<g id="Info2Btn" transform="translate(-343 -723)">
<path id="Path_184" data-name="Path 184" d="M8.833,0a8.833,8.833,0,1,0,8.833,8.833A8.843,8.843,0,0,0,8.833,0Zm0,16.061a7.227,7.227,0,1,1,7.227-7.227A7.235,7.235,0,0,1,8.833,16.061Z" transform="translate(343 723)"/>
<path id="Path_185" data-name="Path 185" d="M146.072,70a1.071,1.071,0,1,0,1.07,1.071A1.072,1.072,0,0,0,146.072,70Z" transform="translate(205.761 656.747)"/>
<path id="Path_186" data-name="Path 186" d="M150.8,140a.8.8,0,0,0-.8.8v4.818a.8.8,0,0,0,1.606,0V140.8A.8.8,0,0,0,150.8,140Z" transform="translate(201.03 590.495)"/>
</g>
</svg>
</button>
</div>
<div class="col-6 text-right">
<div class="folder-wrapper__filters">
<div class="my-custom-select-wrapper">
<div class="my-custom-select">
<div class="my-custom-select__trigger"><span>Reorder by</span>
<div class="arrow"></div>
</div>
<div class="my-custom-options">
<span class="my-custom-option selected" data-value="Reorder by">Reorder by</span>
<span class="my-custom-option" data-value="Name">Name</span>
<span class="my-custom-option" data-value="Lastest">Lastest</span>
<span class="my-custom-option" data-value="Older">Older</span>
<span class="my-custom-option" data-value="Number of rooms">Number of rooms</span>
<span class="my-custom-option" data-value="Most visited">Most visited</span>
</div>
</div>
</div>

<div class="folder-wrapper__buttons">
<button class="shere">
<svg id="share" xmlns="http://www.w3.org/2000/svg" width="42.5" height="42.5" viewBox="0 0 42.5 42.5">
<path id="Path_226" data-name="Path 226" d="M2.5,0A2.5,2.5,0,1,1,0,2.5,2.5,2.5,0,0,1,2.5,0Z" transform="translate(10 19)" fill="#384765"></path>
<path id="Path_225" data-name="Path 225" d="M2.5,0A2.5,2.5,0,1,1,0,2.5,2.5,2.5,0,0,1,2.5,0Z" transform="translate(25 26)" fill="#384765"></path>
<path id="Path_224" data-name="Path 224" d="M2.5,0A2.5,2.5,0,1,1,0,2.5,2.5,2.5,0,0,1,2.5,0Z" transform="translate(25 11)" fill="#384765"></path>
<path id="Path_209" data-name="Path 209" d="M21.25,0A21.25,21.25,0,1,0,42.5,21.25,21.333,21.333,0,0,0,21.25,0ZM17.484,21.556l6.348,3.794a5.112,5.112,0,1,1-1.181,2.195l-5.96-3.562a5,5,0,1,1-.3-5.842l6.193-3.46a5.046,5.046,0,1,1,1.069,2.255L17.43,20.413a2.916,2.916,0,0,1,.054,1.143Z" fill="#384765"></path>
</svg>
</button>
<button class="delete" data-toggle="modal" data-target="#deleteFolder">
<svg xmlns="http://www.w3.org/2000/svg" width="43" height="43" viewBox="0 0 43 43">
<g id="trash" transform="translate(11.363 9.917)">
<circle id="Ellipse_36" data-name="Ellipse 36" cx="21.5" cy="21.5" r="21.5" transform="translate(-11.363 -9.917)" fill="#fb561b"></circle>
<path id="Path_408" data-name="Path 408" d="M63.808,128.863a1.849,1.849,0,0,0,1.914,1.655H73.9a1.882,1.882,0,0,0,1.947-1.687l1.33-13.886H62.186Z" transform="translate(-59.104 -107.806)" fill="#fff"></path>
<path id="Path_409" data-name="Path 409" d="M33.059,2.92H27.024V1.882A1.817,1.817,0,0,0,25.274,0H21.087a1.817,1.817,0,0,0-1.85,1.783q0,.049,0,.1V2.92H13.2a.649.649,0,0,0,0,1.3H33.059a.649.649,0,1,0,0-1.3ZM25.726,1.882V2.92H20.535V1.882a.519.519,0,0,1,.552-.584h4.088a.519.519,0,0,1,.554.481A.513.513,0,0,1,25.726,1.882Z" transform="translate(-12.554 0)" fill="#fff"></path>
</g>
</svg>
</button>
</div>
</div>
</div>
</div>
</div>
<div class="row">
<div class="col-12 js-saved-images-box">
<div class="folder-wrapper__saved-elements">
<figure class="folder-wrapper__saved-element specification-sheet">
<figcaption class="folder-wrapper__saved-element--folders">
<span class="folder-wrapper__saved-element--folders-img">
<svg xmlns="http://www.w3.org/2000/svg" width="24.704" height="16.27" viewBox="0 0 24.704 16.27">
<g id="open-folder-black-and-white-variant" transform="translate(0 -87.578)">
<path id="Path_434" data-name="Path 434" d="M18.618,102.844a1.7,1.7,0,0,0,1.429-.84l4.57-8.648c.273-.526-.124-.84-.84-.84H19.163V90.451a1.3,1.3,0,0,0-1.293-1.293H6.573l-.838-2.2a.59.59,0,0,0-.551-.38H.6a.589.589,0,0,0-.59.593l.011,3.28L0,101.554a1.3,1.3,0,0,0,1.293,1.293m16.69-10.33H7.922a1.392,1.392,0,0,0-1.134.84l-4.109,8.311H1.293a.114.114,0,0,1-.114-.114v-13.8h3.6l.838,2.2a.59.59,0,0,0,.551.38h11.7a.114.114,0,0,1,.114.114v2.066Z" transform="translate(0 1)" fill="#fff"/>
</g>
</svg>
</span>
<div class="folder-wrapper__saved-element--buttons">
<button class="shere">
<svg xmlns="http://www.w3.org/2000/svg" width="23.547" height="25.688" viewBox="0 0 23.547 25.688"><defs><style>.share-white{fill:#fff;}</style></defs><g transform="translate(0)"><path class="share-white" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"/><path class="share-white" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"/><path class="share-white" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"/><path class="share-white" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"/><path class="share-white" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"/><path class="share-white" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"/><path class="share-white" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"/><path class="share-white" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"/></g></svg>
</button>
<button class="delete" data-toggle="modal" data-target="#deleteFolder">
<svg xmlns="http://www.w3.org/2000/svg" width="14.932" height="16.033" viewBox="0 0 14.932 16.033"><defs><style>.trash-white{fill:#fff;}</style></defs><g transform="translate(0 0)"><g transform="translate(0 0)"><g transform="translate(0 0)"><path class="trash-white" d="M63.331,124.769a1.305,1.305,0,0,0,1.351,1.168h5.771a1.328,1.328,0,0,0,1.374-1.191l.939-9.8H62.186Z" transform="translate(-60.01 -109.905)"/><path class="trash-white" d="M27.028,2.061h-4.26V1.328A1.283,1.283,0,0,0,21.533,0H18.577a1.282,1.282,0,0,0-1.306,1.259q0,.035,0,.07v.733h-4.26a.458.458,0,0,0,0,.916H27.028a.458.458,0,1,0,0-.916Zm-5.176-.733v.733H18.188V1.328a.366.366,0,0,1,.389-.412h2.886a.366.366,0,0,1,.391.34A.362.362,0,0,1,21.852,1.328Z" transform="translate(-12.554 0)"/></g></g></g></svg>
</button>
</div>
<p class="folder-wrapper__saved-element--text first">Specification sheet</p>
<button class="folder-wrapper__saved-element--folders-button"><span onClick="open_specs();">open folder</span></button>
</figcaption>
</figure>
<figure class="folder-wrapper__saved-element add-new-button js-url-modal-btn" data-tab-parrent="#v-pills-basement" data-button-positon="room-name" data-toggle="modal" data-target="#newImageUrl">
<figcaption class="add-new-button__wrap">

<span class="svg-group">
<span class="svg-group__first">
<svg xmlns="http://www.w3.org/2000/svg" width="34.215" height="51.323" viewBox="0 0 34.215 51.323">
<path id="Path_451" data-name="Path 451" d="M161.684,17.839,146.714.731a2.134,2.134,0,0,0-3.216,0L128.529,17.839a2.137,2.137,0,0,0,1.608,3.546h8.554v27.8a2.139,2.139,0,0,0,2.138,2.138h8.554a2.139,2.139,0,0,0,2.138-2.138v-27.8h8.554a2.137,2.137,0,0,0,1.608-3.546Z" transform="translate(-127.998)" fill="#fff"/>
</svg>
</span>
<span class="svg-group__second">
<svg xmlns="http://www.w3.org/2000/svg" width="21.992" height="9.797" viewBox="0 0 21.992 9.797">
<path id="Path_448" data-name="Path 448" d="M20.286,207.506a1.764,1.764,0,0,0-1.764,1.764v4.5H3.586v-4.5a1.764,1.764,0,0,0-3.528,0v6.269A1.764,1.764,0,0,0,1.822,217.3H20.286a1.764,1.764,0,0,0,1.764-1.764V209.27A1.764,1.764,0,0,0,20.286,207.506Z" transform="translate(-0.058 -207.506)" fill="#fff"/>
</svg>
</span>
</span>

<p class="folder-wrapper__saved-element--folders-text">Add an external URL of image or upload an image from the device</p>
</figcaption>
</figure>
<figure class="folder-wrapper__saved-element">
<img src="<?php echo SITEROOT; ?>images/idea-folder-room-3.png" alt="" class="folder-wrapper__saved-element--img img-fluid">
<figcaption class="folder-wrapper__saved-element--text-box">
<a href="#" title="" class="folder-wrapper__saved-element--link"></a>
<div class="folder-wrapper__saved-element--buttons">
<button class="shere">
<svg xmlns="http://www.w3.org/2000/svg" width="23.547" height="25.688" viewBox="0 0 23.547 25.688"><defs><style>.share-white{fill:#fff;}</style></defs><g transform="translate(0)"><path class="share-white" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"/><path class="share-white" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"/><path class="share-white" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"/><path class="share-white" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"/><path class="share-white" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"/><path class="share-white" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"/><path class="share-white" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"/><path class="share-white" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"/></g></svg>
</button>
<button class="delete" data-toggle="modal" data-target="#deleteFolder">
<svg xmlns="http://www.w3.org/2000/svg" width="14.932" height="16.033" viewBox="0 0 14.932 16.033"><defs><style>.trash-white{fill:#fff;}</style></defs><g transform="translate(0 0)"><g transform="translate(0 0)"><g transform="translate(0 0)"><path class="trash-white" d="M63.331,124.769a1.305,1.305,0,0,0,1.351,1.168h5.771a1.328,1.328,0,0,0,1.374-1.191l.939-9.8H62.186Z" transform="translate(-60.01 -109.905)"/><path class="trash-white" d="M27.028,2.061h-4.26V1.328A1.283,1.283,0,0,0,21.533,0H18.577a1.282,1.282,0,0,0-1.306,1.259q0,.035,0,.07v.733h-4.26a.458.458,0,0,0,0,.916H27.028a.458.458,0,1,0,0-.916Zm-5.176-.733v.733H18.188V1.328a.366.366,0,0,1,.389-.412h2.886a.366.366,0,0,1,.391.34A.362.362,0,0,1,21.852,1.328Z" transform="translate(-12.554 0)"/></g></g></g></svg>
</button>
</div>
<p class="folder-wrapper__saved-element--text">Go to product details</p>
</figcaption>
</figure>
<figure class="folder-wrapper__saved-element">
<img src="<?php echo SITEROOT; ?>images/idea-folder-room-4.png" alt="" class="folder-wrapper__saved-element--img img-fluid">
<figcaption class="folder-wrapper__saved-element--text-box">
<a href="#" title="" class="folder-wrapper__saved-element--link"></a>
<div class="folder-wrapper__saved-element--buttons">
<button class="shere">
<svg xmlns="http://www.w3.org/2000/svg" width="23.547" height="25.688" viewBox="0 0 23.547 25.688"><defs><style>.share-white{fill:#fff;}</style></defs><g transform="translate(0)"><path class="share-white" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"/><path class="share-white" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"/><path class="share-white" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"/><path class="share-white" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"/><path class="share-white" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"/><path class="share-white" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"/><path class="share-white" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"/><path class="share-white" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"/></g></svg>
</button>
<button class="delete" data-toggle="modal" data-target="#deleteFolder">
<svg xmlns="http://www.w3.org/2000/svg" width="14.932" height="16.033" viewBox="0 0 14.932 16.033"><defs><style>.trash-white{fill:#fff;}</style></defs><g transform="translate(0 0)"><g transform="translate(0 0)"><g transform="translate(0 0)"><path class="trash-white" d="M63.331,124.769a1.305,1.305,0,0,0,1.351,1.168h5.771a1.328,1.328,0,0,0,1.374-1.191l.939-9.8H62.186Z" transform="translate(-60.01 -109.905)"/><path class="trash-white" d="M27.028,2.061h-4.26V1.328A1.283,1.283,0,0,0,21.533,0H18.577a1.282,1.282,0,0,0-1.306,1.259q0,.035,0,.07v.733h-4.26a.458.458,0,0,0,0,.916H27.028a.458.458,0,1,0,0-.916Zm-5.176-.733v.733H18.188V1.328a.366.366,0,0,1,.389-.412h2.886a.366.366,0,0,1,.391.34A.362.362,0,0,1,21.852,1.328Z" transform="translate(-12.554 0)"/></g></g></g></svg>
</button>
</div>
<p class="folder-wrapper__saved-element--text">Go to product details</p>
</figcaption>
</figure>
<figure class="folder-wrapper__saved-element">
<img src="<?php echo SITEROOT; ?>images/idea-folder-room-5.png" alt="" class="folder-wrapper__saved-element--img img-fluid">
<figcaption class="folder-wrapper__saved-element--text-box">
<a href="#" title="" class="folder-wrapper__saved-element--link"></a>
<div class="folder-wrapper__saved-element--buttons">
<button class="shere">
<svg xmlns="http://www.w3.org/2000/svg" width="23.547" height="25.688" viewBox="0 0 23.547 25.688"><defs><style>.share-white{fill:#fff;}</style></defs><g transform="translate(0)"><path class="share-white" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"/><path class="share-white" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"/><path class="share-white" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"/><path class="share-white" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"/><path class="share-white" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"/><path class="share-white" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"/><path class="share-white" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"/><path class="share-white" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"/></g></svg>
</button>
<button class="delete" data-toggle="modal" data-target="#deleteFolder">
<svg xmlns="http://www.w3.org/2000/svg" width="14.932" height="16.033" viewBox="0 0 14.932 16.033"><defs><style>.trash-white{fill:#fff;}</style></defs><g transform="translate(0 0)"><g transform="translate(0 0)"><g transform="translate(0 0)"><path class="trash-white" d="M63.331,124.769a1.305,1.305,0,0,0,1.351,1.168h5.771a1.328,1.328,0,0,0,1.374-1.191l.939-9.8H62.186Z" transform="translate(-60.01 -109.905)"/><path class="trash-white" d="M27.028,2.061h-4.26V1.328A1.283,1.283,0,0,0,21.533,0H18.577a1.282,1.282,0,0,0-1.306,1.259q0,.035,0,.07v.733h-4.26a.458.458,0,0,0,0,.916H27.028a.458.458,0,1,0,0-.916Zm-5.176-.733v.733H18.188V1.328a.366.366,0,0,1,.389-.412h2.886a.366.366,0,0,1,.391.34A.362.362,0,0,1,21.852,1.328Z" transform="translate(-12.554 0)"/></g></g></g></svg>
</button>
</div>
<p class="folder-wrapper__saved-element--text">Go to product details</p>
</figcaption>
</figure>
<figure class="folder-wrapper__saved-element folders">
<figcaption class="folder-wrapper__saved-element--folders">
<span class="folder-wrapper__saved-element--folders-img">
<svg xmlns="http://www.w3.org/2000/svg" width="86" height="71.044" viewBox="0 0 86 71.044"><defs><style>.folder-orange{fill:#edb700;}</style></defs><g transform="translate(-10.667)"><g transform="translate(10.667 7.478)"><g transform="translate(0)"><path class="folder-orange" d="M87.319,53.884H44.1a5.6,5.6,0,0,1-5.321-3.836l-.329-.991a9.337,9.337,0,0,0-8.865-6.39H20.015a9.361,9.361,0,0,0-9.348,9.348v44.87a9.358,9.358,0,0,0,9.348,9.348H34.971a1.87,1.87,0,1,0,0-3.739H20.015a5.615,5.615,0,0,1-5.609-5.609V52.015a5.615,5.615,0,0,1,5.609-5.609h9.568A5.6,5.6,0,0,1,34.9,50.239l.333.995a9.337,9.337,0,0,0,8.865,6.39H87.319a5.615,5.615,0,0,1,5.609,5.609V96.884a5.615,5.615,0,0,1-5.609,5.609H72.363a1.87,1.87,0,0,0,0,3.739H87.319a9.356,9.356,0,0,0,9.348-9.348V63.232A9.358,9.358,0,0,0,87.319,53.884Z" transform="translate(-10.667 -42.667)"/></g></g><g transform="translate(14.406)"><path class="folder-orange" d="M101.174,0H41.348A9.361,9.361,0,0,0,32,9.348a1.87,1.87,0,0,0,3.739,0,5.615,5.615,0,0,1,5.609-5.609h59.826a5.615,5.615,0,0,1,5.609,5.609V20.565a1.87,1.87,0,1,0,3.739,0V9.348A9.359,9.359,0,0,0,101.174,0Z" transform="translate(-32)"/></g></g></svg>
</span>
<p class="folder-wrapper__saved-element--folders-text">Nice things for living room</p>
<button class="folder-wrapper__saved-element--folders-button js-show-add-to-rooms-new-idea-folder-images-btn">View folder</button>
</figcaption>
</figure>
<figure class="folder-wrapper__saved-element">
<img src="<?php echo SITEROOT; ?>images/idea-folder-room-2.png" alt="" class="folder-wrapper__saved-element--img img-fluid">
<figcaption class="folder-wrapper__saved-element--text-box">
<a href="#" title="" class="folder-wrapper__saved-element--link"></a>
<div class="folder-wrapper__saved-element--buttons">
<button class="shere">
<svg xmlns="http://www.w3.org/2000/svg" width="23.547" height="25.688" viewBox="0 0 23.547 25.688"><defs><style>.share-white{fill:#fff;}</style></defs><g transform="translate(0)"><path class="share-white" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"/><path class="share-white" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"/><path class="share-white" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"/><path class="share-white" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"/><path class="share-white" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"/><path class="share-white" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"/><path class="share-white" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"/><path class="share-white" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"/></g></svg>
</button>
<button class="delete" data-toggle="modal" data-target="#deleteFolder">
<svg xmlns="http://www.w3.org/2000/svg" width="14.932" height="16.033" viewBox="0 0 14.932 16.033"><defs><style>.trash-white{fill:#fff;}</style></defs><g transform="translate(0 0)"><g transform="translate(0 0)"><g transform="translate(0 0)"><path class="trash-white" d="M63.331,124.769a1.305,1.305,0,0,0,1.351,1.168h5.771a1.328,1.328,0,0,0,1.374-1.191l.939-9.8H62.186Z" transform="translate(-60.01 -109.905)"/><path class="trash-white" d="M27.028,2.061h-4.26V1.328A1.283,1.283,0,0,0,21.533,0H18.577a1.282,1.282,0,0,0-1.306,1.259q0,.035,0,.07v.733h-4.26a.458.458,0,0,0,0,.916H27.028a.458.458,0,1,0,0-.916Zm-5.176-.733v.733H18.188V1.328a.366.366,0,0,1,.389-.412h2.886a.366.366,0,0,1,.391.34A.362.362,0,0,1,21.852,1.328Z" transform="translate(-12.554 0)"/></g></g></g></svg>
</button>
</div>
<p class="folder-wrapper__saved-element--text">Go to product details</p>
</figcaption>
</figure>
</div>
</div>

<div class="col-12 js-specification-sheet-box" style="display: none;">
<div class="folder-wrapper__specification-sheet--wrapper">

<div class="folder-wrapper__specification-sheet--buttons-box">

<div class="folder-wrapper__specification-sheet--buttons-box-content">
<span class="folder-wrapper__specification-sheet--buttons-box-image">
<svg xmlns="http://www.w3.org/2000/svg" width="24.704" height="16.27" viewBox="0 0 24.704 16.27">
<g id="open-folder-black-and-white-variant" transform="translate(0 -87.578)">
<path id="Path_434" data-name="Path 434" d="M18.618,102.844a1.7,1.7,0,0,0,1.429-.84l4.57-8.648c.273-.526-.124-.84-.84-.84H19.163V90.451a1.3,1.3,0,0,0-1.293-1.293H6.573l-.838-2.2a.59.59,0,0,0-.551-.38H.6a.589.589,0,0,0-.59.593l.011,3.28L0,101.554a1.3,1.3,0,0,0,1.293,1.293m16.69-10.33H7.922a1.392,1.392,0,0,0-1.134.84l-4.109,8.311H1.293a.114.114,0,0,1-.114-.114v-13.8h3.6l.838,2.2a.59.59,0,0,0,.551.38h11.7a.114.114,0,0,1,.114.114v2.066Z" transform="translate(0 1)" fill="#fff"/>
</g>
</svg>
</span>

<button class="folder-wrapper__specification-sheet--button js-hide-specification-sheet-box-btn">
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 495.785 495.785" xml:space="preserve"><path id="XMLID_26_" d="M436.855,90.337L255.175,0.541c-1.62-0.801-3.533-0.707-5.084,0.249c-1.535,0.957-2.467,2.638-2.467,4.449  v36.834H56.017v453.713h105.924V147.996h85.684v36.833c0,1.812,0.932,3.492,2.467,4.449c1.551,0.956,3.464,1.052,5.084,0.249  l181.68-89.796c1.791-0.888,2.914-2.706,2.914-4.698C439.769,93.043,438.646,91.225,436.855,90.337z"/><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
../ Specification sheet
</button>
</div>

<div class="d-flex justify-content-center align-items-center">
<div class="house-checkbox">
<input class="custom-checkbox js-load-confirm-modal" id="checkbox-11" type="checkbox" value="value11" data-target="#confirmModal">
<label for="checkbox-11">Share with Closets To Go</label>
</div>

<button class="folder-wrapper__specification-sheet--button second-button js-hide-specification-sheet-box-btn">
Back
</button>
</div>
</div>

<div class="folder-wrapper__specification-sheet--wrapper-content">
<h3 class="folder-wrapper__specification-sheet--wrapper-heading">Accessory</h3>

<div class="folder-wrapper__specification-sheet--wrapper-image-wrap">
<figure class="folder-wrapper__specification-sheet--wrapper-image-box">
<img src="<?php echo SITEROOT; ?>images/idea-folder-room-5.png" alt="" class="folder-wrapper__specification-sheet--wrapper-image-img img-fluid">

<figcaption class="folder-wrapper__specification-sheet--wrapper-image-content">
<div class="folder-wrapper__specification-sheet--wrapper-image-buttons">
<button class="shere">
<svg xmlns="http://www.w3.org/2000/svg" width="23.547" height="25.688" viewBox="0 0 23.547 25.688"><defs><style>.share-white{fill:#fff;}</style></defs><g transform="translate(0)"><path class="share-white" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"/><path class="share-white" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"/><path class="share-white" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"/><path class="share-white" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"/><path class="share-white" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"/><path class="share-white" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"/><path class="share-white" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"/><path class="share-white" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"/></g></svg>
</button>
<button class="delete" data-toggle="modal" data-target="#deleteFolder">
<svg xmlns="http://www.w3.org/2000/svg" width="14.932" height="16.033" viewBox="0 0 14.932 16.033"><defs><style>.trash-white{fill:#fff;}</style></defs><g transform="translate(0 0)"><g transform="translate(0 0)"><g transform="translate(0 0)"><path class="trash-white" d="M63.331,124.769a1.305,1.305,0,0,0,1.351,1.168h5.771a1.328,1.328,0,0,0,1.374-1.191l.939-9.8H62.186Z" transform="translate(-60.01 -109.905)"/><path class="trash-white" d="M27.028,2.061h-4.26V1.328A1.283,1.283,0,0,0,21.533,0H18.577a1.282,1.282,0,0,0-1.306,1.259q0,.035,0,.07v.733h-4.26a.458.458,0,0,0,0,.916H27.028a.458.458,0,1,0,0-.916Zm-5.176-.733v.733H18.188V1.328a.366.366,0,0,1,.389-.412h2.886a.366.366,0,0,1,.391.34A.362.362,0,0,1,21.852,1.328Z" transform="translate(-12.554 0)"/></g></g></g></svg>
</button>
</div>
<p class="folder-wrapper__specification-sheet--wrapper-image-text">Go to product details</p>
</figcaption>
</figure>

<figure class="folder-wrapper__specification-sheet--wrapper-image-box">
<img src="<?php echo SITEROOT; ?>images/idea-folder-room-2.png" alt="" class="folder-wrapper__specification-sheet--wrapper-image-img img-fluid">

<figcaption class="folder-wrapper__specification-sheet--wrapper-image-content">
<div class="folder-wrapper__specification-sheet--wrapper-image-buttons">
<button class="shere">
<svg xmlns="http://www.w3.org/2000/svg" width="23.547" height="25.688" viewBox="0 0 23.547 25.688"><defs><style>.share-white{fill:#fff;}</style></defs><g transform="translate(0)"><path class="share-white" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"/><path class="share-white" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"/><path class="share-white" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"/><path class="share-white" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"/><path class="share-white" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"/><path class="share-white" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"/><path class="share-white" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"/><path class="share-white" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"/></g></svg>
</button>
<button class="delete" data-toggle="modal" data-target="#deleteFolder">
<svg xmlns="http://www.w3.org/2000/svg" width="14.932" height="16.033" viewBox="0 0 14.932 16.033"><defs><style>.trash-white{fill:#fff;}</style></defs><g transform="translate(0 0)"><g transform="translate(0 0)"><g transform="translate(0 0)"><path class="trash-white" d="M63.331,124.769a1.305,1.305,0,0,0,1.351,1.168h5.771a1.328,1.328,0,0,0,1.374-1.191l.939-9.8H62.186Z" transform="translate(-60.01 -109.905)"/><path class="trash-white" d="M27.028,2.061h-4.26V1.328A1.283,1.283,0,0,0,21.533,0H18.577a1.282,1.282,0,0,0-1.306,1.259q0,.035,0,.07v.733h-4.26a.458.458,0,0,0,0,.916H27.028a.458.458,0,1,0,0-.916Zm-5.176-.733v.733H18.188V1.328a.366.366,0,0,1,.389-.412h2.886a.366.366,0,0,1,.391.34A.362.362,0,0,1,21.852,1.328Z" transform="translate(-12.554 0)"/></g></g></g></svg>
</button>
</div>
<p class="folder-wrapper__specification-sheet--wrapper-image-text">Go to product details</p>
</figcaption>
</figure>

<figure class="folder-wrapper__specification-sheet--wrapper-image-box">
<img src="<?php echo SITEROOT; ?>images/idea-folder-room-3.png" alt="" class="folder-wrapper__specification-sheet--wrapper-image-img img-fluid">

<figcaption class="folder-wrapper__specification-sheet--wrapper-image-content">
<div class="folder-wrapper__specification-sheet--wrapper-image-buttons">
<button class="shere">
<svg xmlns="http://www.w3.org/2000/svg" width="23.547" height="25.688" viewBox="0 0 23.547 25.688"><defs><style>.share-white{fill:#fff;}</style></defs><g transform="translate(0)"><path class="share-white" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"/><path class="share-white" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"/><path class="share-white" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"/><path class="share-white" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"/><path class="share-white" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"/><path class="share-white" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"/><path class="share-white" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"/><path class="share-white" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"/></g></svg>
</button>
<button class="delete" data-toggle="modal" data-target="#deleteFolder">
<svg xmlns="http://www.w3.org/2000/svg" width="14.932" height="16.033" viewBox="0 0 14.932 16.033"><defs><style>.trash-white{fill:#fff;}</style></defs><g transform="translate(0 0)"><g transform="translate(0 0)"><g transform="translate(0 0)"><path class="trash-white" d="M63.331,124.769a1.305,1.305,0,0,0,1.351,1.168h5.771a1.328,1.328,0,0,0,1.374-1.191l.939-9.8H62.186Z" transform="translate(-60.01 -109.905)"/><path class="trash-white" d="M27.028,2.061h-4.26V1.328A1.283,1.283,0,0,0,21.533,0H18.577a1.282,1.282,0,0,0-1.306,1.259q0,.035,0,.07v.733h-4.26a.458.458,0,0,0,0,.916H27.028a.458.458,0,1,0,0-.916Zm-5.176-.733v.733H18.188V1.328a.366.366,0,0,1,.389-.412h2.886a.366.366,0,0,1,.391.34A.362.362,0,0,1,21.852,1.328Z" transform="translate(-12.554 0)"/></g></g></g></svg>
</button>
</div>
<p class="folder-wrapper__specification-sheet--wrapper-image-text">Go to product details</p>
</figcaption>
</figure>
</div>

<h3 class="folder-wrapper__specification-sheet--wrapper-heading">Material color</h3>

<p class="folder-wrapper__specification-sheet--wrapper-text">Closet organizers are the ultimate do it yourself project. They not only make your life simpler, they also bring about a lifetime of satisfaction. The Closets To Go closet organizers are the easiest to design and assemble. From our easy-to-adjust hanging bracket to the pre-assembly of all your hardware fittings and labeled panels, we've virtually made reading instructions a thing of the past. Our custom closet organizers are the easiest to install in the nation, guaranteed! They're also constructed with high-quality, environmentally-friendly materials made right here in the United States.</p>

<div class="folder-wrapper__specification-sheet--wrapper-image-wrap">
<figure class="folder-wrapper__specification-sheet--wrapper-image-box">
<img src="<?php echo SITEROOT; ?>images/idea-folder-room-5.png" alt="" class="folder-wrapper__specification-sheet--wrapper-image-img img-fluid">

<figcaption class="folder-wrapper__specification-sheet--wrapper-image-content">
<div class="folder-wrapper__specification-sheet--wrapper-image-buttons">
<button class="shere">
<svg xmlns="http://www.w3.org/2000/svg" width="23.547" height="25.688" viewBox="0 0 23.547 25.688"><defs><style>.share-white{fill:#fff;}</style></defs><g transform="translate(0)"><path class="share-white" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"/><path class="share-white" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"/><path class="share-white" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"/><path class="share-white" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"/><path class="share-white" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"/><path class="share-white" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"/><path class="share-white" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"/><path class="share-white" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"/></g></svg>
</button>
<button class="delete" data-toggle="modal" data-target="#deleteFolder">
<svg xmlns="http://www.w3.org/2000/svg" width="14.932" height="16.033" viewBox="0 0 14.932 16.033"><defs><style>.trash-white{fill:#fff;}</style></defs><g transform="translate(0 0)"><g transform="translate(0 0)"><g transform="translate(0 0)"><path class="trash-white" d="M63.331,124.769a1.305,1.305,0,0,0,1.351,1.168h5.771a1.328,1.328,0,0,0,1.374-1.191l.939-9.8H62.186Z" transform="translate(-60.01 -109.905)"/><path class="trash-white" d="M27.028,2.061h-4.26V1.328A1.283,1.283,0,0,0,21.533,0H18.577a1.282,1.282,0,0,0-1.306,1.259q0,.035,0,.07v.733h-4.26a.458.458,0,0,0,0,.916H27.028a.458.458,0,1,0,0-.916Zm-5.176-.733v.733H18.188V1.328a.366.366,0,0,1,.389-.412h2.886a.366.366,0,0,1,.391.34A.362.362,0,0,1,21.852,1.328Z" transform="translate(-12.554 0)"/></g></g></g></svg>
</button>
</div>
<p class="folder-wrapper__specification-sheet--wrapper-image-text">Go to product details</p>
</figcaption>
</figure>

<figure class="folder-wrapper__specification-sheet--wrapper-image-box">
<img src="<?php echo SITEROOT; ?>images/idea-folder-room-2.png" alt="" class="folder-wrapper__specification-sheet--wrapper-image-img img-fluid">

<figcaption class="folder-wrapper__specification-sheet--wrapper-image-content">
<div class="folder-wrapper__specification-sheet--wrapper-image-buttons">
<button class="shere">
<svg xmlns="http://www.w3.org/2000/svg" width="23.547" height="25.688" viewBox="0 0 23.547 25.688"><defs><style>.share-white{fill:#fff;}</style></defs><g transform="translate(0)"><path class="share-white" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"/><path class="share-white" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"/><path class="share-white" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"/><path class="share-white" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"/><path class="share-white" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"/><path class="share-white" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"/><path class="share-white" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"/><path class="share-white" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"/></g></svg>
</button>
<button class="delete" data-toggle="modal" data-target="#deleteFolder">
<svg xmlns="http://www.w3.org/2000/svg" width="14.932" height="16.033" viewBox="0 0 14.932 16.033"><defs><style>.trash-white{fill:#fff;}</style></defs><g transform="translate(0 0)"><g transform="translate(0 0)"><g transform="translate(0 0)"><path class="trash-white" d="M63.331,124.769a1.305,1.305,0,0,0,1.351,1.168h5.771a1.328,1.328,0,0,0,1.374-1.191l.939-9.8H62.186Z" transform="translate(-60.01 -109.905)"/><path class="trash-white" d="M27.028,2.061h-4.26V1.328A1.283,1.283,0,0,0,21.533,0H18.577a1.282,1.282,0,0,0-1.306,1.259q0,.035,0,.07v.733h-4.26a.458.458,0,0,0,0,.916H27.028a.458.458,0,1,0,0-.916Zm-5.176-.733v.733H18.188V1.328a.366.366,0,0,1,.389-.412h2.886a.366.366,0,0,1,.391.34A.362.362,0,0,1,21.852,1.328Z" transform="translate(-12.554 0)"/></g></g></g></svg>
</button>
</div>
<p class="folder-wrapper__specification-sheet--wrapper-image-text">Go to product details</p>
</figcaption>
</figure>

<figure class="folder-wrapper__specification-sheet--wrapper-image-box">
<img src="<?php echo SITEROOT; ?>images/idea-folder-room-3.png" alt="" class="folder-wrapper__specification-sheet--wrapper-image-img img-fluid">

<figcaption class="folder-wrapper__specification-sheet--wrapper-image-content">
<div class="folder-wrapper__specification-sheet--wrapper-image-buttons">
<button class="shere">
<svg xmlns="http://www.w3.org/2000/svg" width="23.547" height="25.688" viewBox="0 0 23.547 25.688"><defs><style>.share-white{fill:#fff;}</style></defs><g transform="translate(0)"><path class="share-white" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"/><path class="share-white" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"/><path class="share-white" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"/><path class="share-white" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"/><path class="share-white" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"/><path class="share-white" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"/><path class="share-white" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"/><path class="share-white" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"/></g></svg>
</button>
<button class="delete" data-toggle="modal" data-target="#deleteFolder">
<svg xmlns="http://www.w3.org/2000/svg" width="14.932" height="16.033" viewBox="0 0 14.932 16.033"><defs><style>.trash-white{fill:#fff;}</style></defs><g transform="translate(0 0)"><g transform="translate(0 0)"><g transform="translate(0 0)"><path class="trash-white" d="M63.331,124.769a1.305,1.305,0,0,0,1.351,1.168h5.771a1.328,1.328,0,0,0,1.374-1.191l.939-9.8H62.186Z" transform="translate(-60.01 -109.905)"/><path class="trash-white" d="M27.028,2.061h-4.26V1.328A1.283,1.283,0,0,0,21.533,0H18.577a1.282,1.282,0,0,0-1.306,1.259q0,.035,0,.07v.733h-4.26a.458.458,0,0,0,0,.916H27.028a.458.458,0,1,0,0-.916Zm-5.176-.733v.733H18.188V1.328a.366.366,0,0,1,.389-.412h2.886a.366.366,0,0,1,.391.34A.362.362,0,0,1,21.852,1.328Z" transform="translate(-12.554 0)"/></g></g></g></svg>
</button>
</div>
<p class="folder-wrapper__specification-sheet--wrapper-image-text">Go to product details</p>
</figcaption>
</figure>

<figure class="folder-wrapper__specification-sheet--wrapper-image-box">
<img src="<?php echo SITEROOT; ?>images/idea-folder-room-4.png" alt="" class="folder-wrapper__specification-sheet--wrapper-image-img img-fluid">

<figcaption class="folder-wrapper__specification-sheet--wrapper-image-content">
<div class="folder-wrapper__specification-sheet--wrapper-image-buttons">
<button class="shere">
<svg xmlns="http://www.w3.org/2000/svg" width="23.547" height="25.688" viewBox="0 0 23.547 25.688"><defs><style>.share-white{fill:#fff;}</style></defs><g transform="translate(0)"><path class="share-white" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"/><path class="share-white" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"/><path class="share-white" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"/><path class="share-white" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"/><path class="share-white" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"/><path class="share-white" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"/><path class="share-white" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"/><path class="share-white" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"/></g></svg>
</button>
<button class="delete" data-toggle="modal" data-target="#deleteFolder">
<svg xmlns="http://www.w3.org/2000/svg" width="14.932" height="16.033" viewBox="0 0 14.932 16.033"><defs><style>.trash-white{fill:#fff;}</style></defs><g transform="translate(0 0)"><g transform="translate(0 0)"><g transform="translate(0 0)"><path class="trash-white" d="M63.331,124.769a1.305,1.305,0,0,0,1.351,1.168h5.771a1.328,1.328,0,0,0,1.374-1.191l.939-9.8H62.186Z" transform="translate(-60.01 -109.905)"/><path class="trash-white" d="M27.028,2.061h-4.26V1.328A1.283,1.283,0,0,0,21.533,0H18.577a1.282,1.282,0,0,0-1.306,1.259q0,.035,0,.07v.733h-4.26a.458.458,0,0,0,0,.916H27.028a.458.458,0,1,0,0-.916Zm-5.176-.733v.733H18.188V1.328a.366.366,0,0,1,.389-.412h2.886a.366.366,0,0,1,.391.34A.362.362,0,0,1,21.852,1.328Z" transform="translate(-12.554 0)"/></g></g></g></svg>
</button>
</div>
<p class="folder-wrapper__specification-sheet--wrapper-image-text">Go to product details</p>
</figcaption>
</figure>
</div>

<h3 class="folder-wrapper__specification-sheet--wrapper-heading">Door/drawer style</h3>

<p class="folder-wrapper__specification-sheet--wrapper-text">There is no any items in category.</p>

<h3 class="folder-wrapper__specification-sheet--wrapper-heading">Decorative hardware (handles, knobs, hooks)</h3>

<div class="folder-wrapper__specification-sheet--wrapper-image-wrap">
<figure class="folder-wrapper__specification-sheet--wrapper-image-box">
<img src="<?php echo SITEROOT; ?>images/idea-folder-room-5.png" alt="" class="folder-wrapper__specification-sheet--wrapper-image-img img-fluid">

<figcaption class="folder-wrapper__specification-sheet--wrapper-image-content">
<div class="folder-wrapper__specification-sheet--wrapper-image-buttons">
<button class="shere">
<svg xmlns="http://www.w3.org/2000/svg" width="23.547" height="25.688" viewBox="0 0 23.547 25.688"><defs><style>.share-white{fill:#fff;}</style></defs><g transform="translate(0)"><path class="share-white" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"/><path class="share-white" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"/><path class="share-white" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"/><path class="share-white" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"/><path class="share-white" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"/><path class="share-white" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"/><path class="share-white" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"/><path class="share-white" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"/></g></svg>
</button>
<button class="delete" data-toggle="modal" data-target="#deleteFolder">
<svg xmlns="http://www.w3.org/2000/svg" width="14.932" height="16.033" viewBox="0 0 14.932 16.033"><defs><style>.trash-white{fill:#fff;}</style></defs><g transform="translate(0 0)"><g transform="translate(0 0)"><g transform="translate(0 0)"><path class="trash-white" d="M63.331,124.769a1.305,1.305,0,0,0,1.351,1.168h5.771a1.328,1.328,0,0,0,1.374-1.191l.939-9.8H62.186Z" transform="translate(-60.01 -109.905)"/><path class="trash-white" d="M27.028,2.061h-4.26V1.328A1.283,1.283,0,0,0,21.533,0H18.577a1.282,1.282,0,0,0-1.306,1.259q0,.035,0,.07v.733h-4.26a.458.458,0,0,0,0,.916H27.028a.458.458,0,1,0,0-.916Zm-5.176-.733v.733H18.188V1.328a.366.366,0,0,1,.389-.412h2.886a.366.366,0,0,1,.391.34A.362.362,0,0,1,21.852,1.328Z" transform="translate(-12.554 0)"/></g></g></g></svg>
</button>
</div>
<p class="folder-wrapper__specification-sheet--wrapper-image-text">Go to product details</p>
</figcaption>
</figure>

<figure class="folder-wrapper__specification-sheet--wrapper-image-box">
<img src="<?php echo SITEROOT; ?>images/idea-folder-room-2.png" alt="" class="folder-wrapper__specification-sheet--wrapper-image-img img-fluid">

<figcaption class="folder-wrapper__specification-sheet--wrapper-image-content">
<div class="folder-wrapper__specification-sheet--wrapper-image-buttons">
<button class="shere">
<svg xmlns="http://www.w3.org/2000/svg" width="23.547" height="25.688" viewBox="0 0 23.547 25.688"><defs><style>.share-white{fill:#fff;}</style></defs><g transform="translate(0)"><path class="share-white" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"/><path class="share-white" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"/><path class="share-white" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"/><path class="share-white" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"/><path class="share-white" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"/><path class="share-white" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"/><path class="share-white" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"/><path class="share-white" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"/></g></svg>
</button>
<button class="delete" data-toggle="modal" data-target="#deleteFolder">
<svg xmlns="http://www.w3.org/2000/svg" width="14.932" height="16.033" viewBox="0 0 14.932 16.033"><defs><style>.trash-white{fill:#fff;}</style></defs><g transform="translate(0 0)"><g transform="translate(0 0)"><g transform="translate(0 0)"><path class="trash-white" d="M63.331,124.769a1.305,1.305,0,0,0,1.351,1.168h5.771a1.328,1.328,0,0,0,1.374-1.191l.939-9.8H62.186Z" transform="translate(-60.01 -109.905)"/><path class="trash-white" d="M27.028,2.061h-4.26V1.328A1.283,1.283,0,0,0,21.533,0H18.577a1.282,1.282,0,0,0-1.306,1.259q0,.035,0,.07v.733h-4.26a.458.458,0,0,0,0,.916H27.028a.458.458,0,1,0,0-.916Zm-5.176-.733v.733H18.188V1.328a.366.366,0,0,1,.389-.412h2.886a.366.366,0,0,1,.391.34A.362.362,0,0,1,21.852,1.328Z" transform="translate(-12.554 0)"/></g></g></g></svg>
</button>
</div>
<p class="folder-wrapper__specification-sheet--wrapper-image-text">Go to product details</p>
</figcaption>
</figure>
</div>

<h3 class="folder-wrapper__specification-sheet--wrapper-heading">Wardrobe tube style and finish</h3>

<p class="folder-wrapper__specification-sheet--wrapper-text">Closet organizers are the ultimate do it yourself project. They not only make your life simpler, they also bring about a lifetime of satisfaction. The Closets To Go closet organizers are the easiest to design and assemble. From our easy-to-adjust hanging bracket to the pre-assembly of all your hardware fittings and labeled panels, we've virtually made reading instructions a thing of the past. Our custom closet organizers are the easiest to install in the nation, guaranteed! They're also constructed with high-quality, environmentally-friendly materials made right here in the United States.</p>

<div class="folder-wrapper__specification-sheet--wrapper-image-wrap">
<figure class="folder-wrapper__specification-sheet--wrapper-image-box">
<img src="<?php echo SITEROOT; ?>images/idea-folder-room-5.png" alt="" class="folder-wrapper__specification-sheet--wrapper-image-img img-fluid">

<figcaption class="folder-wrapper__specification-sheet--wrapper-image-content">
<div class="folder-wrapper__specification-sheet--wrapper-image-buttons">
<button class="shere">
<svg xmlns="http://www.w3.org/2000/svg" width="23.547" height="25.688" viewBox="0 0 23.547 25.688"><defs><style>.share-white{fill:#fff;}</style></defs><g transform="translate(0)"><path class="share-white" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"/><path class="share-white" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"/><path class="share-white" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"/><path class="share-white" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"/><path class="share-white" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"/><path class="share-white" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"/><path class="share-white" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"/><path class="share-white" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"/></g></svg>
</button>
<button class="delete" data-toggle="modal" data-target="#deleteFolder">
<svg xmlns="http://www.w3.org/2000/svg" width="14.932" height="16.033" viewBox="0 0 14.932 16.033"><defs><style>.trash-white{fill:#fff;}</style></defs><g transform="translate(0 0)"><g transform="translate(0 0)"><g transform="translate(0 0)"><path class="trash-white" d="M63.331,124.769a1.305,1.305,0,0,0,1.351,1.168h5.771a1.328,1.328,0,0,0,1.374-1.191l.939-9.8H62.186Z" transform="translate(-60.01 -109.905)"/><path class="trash-white" d="M27.028,2.061h-4.26V1.328A1.283,1.283,0,0,0,21.533,0H18.577a1.282,1.282,0,0,0-1.306,1.259q0,.035,0,.07v.733h-4.26a.458.458,0,0,0,0,.916H27.028a.458.458,0,1,0,0-.916Zm-5.176-.733v.733H18.188V1.328a.366.366,0,0,1,.389-.412h2.886a.366.366,0,0,1,.391.34A.362.362,0,0,1,21.852,1.328Z" transform="translate(-12.554 0)"/></g></g></g></svg>
</button>
</div>
<p class="folder-wrapper__specification-sheet--wrapper-image-text">Go to product details</p>
</figcaption>
</figure>

<figure class="folder-wrapper__specification-sheet--wrapper-image-box">
<img src="<?php echo SITEROOT; ?>images/idea-folder-room-2.png" alt="" class="folder-wrapper__specification-sheet--wrapper-image-img img-fluid">

<figcaption class="folder-wrapper__specification-sheet--wrapper-image-content">
<div class="folder-wrapper__specification-sheet--wrapper-image-buttons">
<button class="shere">
<svg xmlns="http://www.w3.org/2000/svg" width="23.547" height="25.688" viewBox="0 0 23.547 25.688"><defs><style>.share-white{fill:#fff;}</style></defs><g transform="translate(0)"><path class="share-white" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"/><path class="share-white" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"/><path class="share-white" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"/><path class="share-white" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"/><path class="share-white" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"/><path class="share-white" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"/><path class="share-white" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"/><path class="share-white" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"/></g></svg>
</button>
<button class="delete" data-toggle="modal" data-target="#deleteFolder">
<svg xmlns="http://www.w3.org/2000/svg" width="14.932" height="16.033" viewBox="0 0 14.932 16.033"><defs><style>.trash-white{fill:#fff;}</style></defs><g transform="translate(0 0)"><g transform="translate(0 0)"><g transform="translate(0 0)"><path class="trash-white" d="M63.331,124.769a1.305,1.305,0,0,0,1.351,1.168h5.771a1.328,1.328,0,0,0,1.374-1.191l.939-9.8H62.186Z" transform="translate(-60.01 -109.905)"/><path class="trash-white" d="M27.028,2.061h-4.26V1.328A1.283,1.283,0,0,0,21.533,0H18.577a1.282,1.282,0,0,0-1.306,1.259q0,.035,0,.07v.733h-4.26a.458.458,0,0,0,0,.916H27.028a.458.458,0,1,0,0-.916Zm-5.176-.733v.733H18.188V1.328a.366.366,0,0,1,.389-.412h2.886a.366.366,0,0,1,.391.34A.362.362,0,0,1,21.852,1.328Z" transform="translate(-12.554 0)"/></g></g></g></svg>
</button>
</div>
<p class="folder-wrapper__specification-sheet--wrapper-image-text">Go to product details</p>
</figcaption>
</figure>

<figure class="folder-wrapper__specification-sheet--wrapper-image-box">
<img src="<?php echo SITEROOT; ?>images/idea-folder-room-3.png" alt="" class="folder-wrapper__specification-sheet--wrapper-image-img img-fluid">

<figcaption class="folder-wrapper__specification-sheet--wrapper-image-content">
<div class="folder-wrapper__specification-sheet--wrapper-image-buttons">
<button class="shere">
<svg xmlns="http://www.w3.org/2000/svg" width="23.547" height="25.688" viewBox="0 0 23.547 25.688"><defs><style>.share-white{fill:#fff;}</style></defs><g transform="translate(0)"><path class="share-white" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"/><path class="share-white" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"/><path class="share-white" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"/><path class="share-white" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"/><path class="share-white" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"/><path class="share-white" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"/><path class="share-white" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"/><path class="share-white" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"/></g></svg>
</button>
<button class="delete" data-toggle="modal" data-target="#deleteFolder">
<svg xmlns="http://www.w3.org/2000/svg" width="14.932" height="16.033" viewBox="0 0 14.932 16.033"><defs><style>.trash-white{fill:#fff;}</style></defs><g transform="translate(0 0)"><g transform="translate(0 0)"><g transform="translate(0 0)"><path class="trash-white" d="M63.331,124.769a1.305,1.305,0,0,0,1.351,1.168h5.771a1.328,1.328,0,0,0,1.374-1.191l.939-9.8H62.186Z" transform="translate(-60.01 -109.905)"/><path class="trash-white" d="M27.028,2.061h-4.26V1.328A1.283,1.283,0,0,0,21.533,0H18.577a1.282,1.282,0,0,0-1.306,1.259q0,.035,0,.07v.733h-4.26a.458.458,0,0,0,0,.916H27.028a.458.458,0,1,0,0-.916Zm-5.176-.733v.733H18.188V1.328a.366.366,0,0,1,.389-.412h2.886a.366.366,0,0,1,.391.34A.362.362,0,0,1,21.852,1.328Z" transform="translate(-12.554 0)"/></g></g></g></svg>
</button>
</div>
<p class="folder-wrapper__specification-sheet--wrapper-image-text">Go to product details</p>
</figcaption>
</figure>

<figure class="folder-wrapper__specification-sheet--wrapper-image-box">
<img src="<?php echo SITEROOT; ?>images/idea-folder-room-4.png" alt="" class="folder-wrapper__specification-sheet--wrapper-image-img img-fluid">

<figcaption class="folder-wrapper__specification-sheet--wrapper-image-content">
<div class="folder-wrapper__specification-sheet--wrapper-image-buttons">
<button class="shere">
<svg xmlns="http://www.w3.org/2000/svg" width="23.547" height="25.688" viewBox="0 0 23.547 25.688"><defs><style>.share-white{fill:#fff;}</style></defs><g transform="translate(0)"><path class="share-white" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"/><path class="share-white" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"/><path class="share-white" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"/><path class="share-white" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"/><path class="share-white" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"/><path class="share-white" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"/><path class="share-white" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"/><path class="share-white" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"/></g></svg>
</button>
<button class="delete" data-toggle="modal" data-target="#deleteFolder">
<svg xmlns="http://www.w3.org/2000/svg" width="14.932" height="16.033" viewBox="0 0 14.932 16.033"><defs><style>.trash-white{fill:#fff;}</style></defs><g transform="translate(0 0)"><g transform="translate(0 0)"><g transform="translate(0 0)"><path class="trash-white" d="M63.331,124.769a1.305,1.305,0,0,0,1.351,1.168h5.771a1.328,1.328,0,0,0,1.374-1.191l.939-9.8H62.186Z" transform="translate(-60.01 -109.905)"/><path class="trash-white" d="M27.028,2.061h-4.26V1.328A1.283,1.283,0,0,0,21.533,0H18.577a1.282,1.282,0,0,0-1.306,1.259q0,.035,0,.07v.733h-4.26a.458.458,0,0,0,0,.916H27.028a.458.458,0,1,0,0-.916Zm-5.176-.733v.733H18.188V1.328a.366.366,0,0,1,.389-.412h2.886a.366.366,0,0,1,.391.34A.362.362,0,0,1,21.852,1.328Z" transform="translate(-12.554 0)"/></g></g></g></svg>
</button>
</div>
<p class="folder-wrapper__specification-sheet--wrapper-image-text">Go to product details</p>
</figcaption>
</figure>
</div>
</div>

<div class="folder-wrapper__specification-sheet--buttons-box">

<div class="folder-wrapper__specification-sheet--buttons-box-content">
<span class="folder-wrapper__specification-sheet--buttons-box-image">
<svg xmlns="http://www.w3.org/2000/svg" width="24.704" height="16.27" viewBox="0 0 24.704 16.27">
<g id="open-folder-black-and-white-variant" transform="translate(0 -87.578)">
<path id="Path_434" data-name="Path 434" d="M18.618,102.844a1.7,1.7,0,0,0,1.429-.84l4.57-8.648c.273-.526-.124-.84-.84-.84H19.163V90.451a1.3,1.3,0,0,0-1.293-1.293H6.573l-.838-2.2a.59.59,0,0,0-.551-.38H.6a.589.589,0,0,0-.59.593l.011,3.28L0,101.554a1.3,1.3,0,0,0,1.293,1.293m16.69-10.33H7.922a1.392,1.392,0,0,0-1.134.84l-4.109,8.311H1.293a.114.114,0,0,1-.114-.114v-13.8h3.6l.838,2.2a.59.59,0,0,0,.551.38h11.7a.114.114,0,0,1,.114.114v2.066Z" transform="translate(0 1)" fill="#fff"/>
</g>
</svg>
</span>

<button class="folder-wrapper__specification-sheet--button js-hide-specification-sheet-box-btn">
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 495.785 495.785" xml:space="preserve"><path id="XMLID_26_" d="M436.855,90.337L255.175,0.541c-1.62-0.801-3.533-0.707-5.084,0.249c-1.535,0.957-2.467,2.638-2.467,4.449  v36.834H56.017v453.713h105.924V147.996h85.684v36.833c0,1.812,0.932,3.492,2.467,4.449c1.551,0.956,3.464,1.052,5.084,0.249  l181.68-89.796c1.791-0.888,2.914-2.706,2.914-4.698C439.769,93.043,438.646,91.225,436.855,90.337z"/><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
../ Specification sheet
</button>
</div>

<button class="folder-wrapper__specification-sheet--button second-fixed-button js-to-top">
Top
</button>

<button class="folder-wrapper__specification-sheet--button second-button js-hide-specification-sheet-box-btn">
Back
</button>
</div>
</div>
</div>

<div class="col-12 js-add-to-rooms-new-idea-folder-images" style="display: none;">
<div class="new-idea-folder-images__wrapper">

<div class="new-idea-folder-images__buttons">

<div class="new-idea-folder-images__buttons-box-content">
<span class="new-idea-folder-images__buttons-box-image">
<svg xmlns="http://www.w3.org/2000/svg" width="24.704" height="16.27" viewBox="0 0 24.704 16.27">
<g id="open-folder-black-and-white-variant" transform="translate(0 -87.578)">
<path id="Path_434" data-name="Path 434" d="M18.618,102.844a1.7,1.7,0,0,0,1.429-.84l4.57-8.648c.273-.526-.124-.84-.84-.84H19.163V90.451a1.3,1.3,0,0,0-1.293-1.293H6.573l-.838-2.2a.59.59,0,0,0-.551-.38H.6a.589.589,0,0,0-.59.593l.011,3.28L0,101.554a1.3,1.3,0,0,0,1.293,1.293m16.69-10.33H7.922a1.392,1.392,0,0,0-1.134.84l-4.109,8.311H1.293a.114.114,0,0,1-.114-.114v-13.8h3.6l.838,2.2a.59.59,0,0,0,.551.38h11.7a.114.114,0,0,1,.114.114v2.066Z" transform="translate(0 1)" fill="#fff"></path>
</g>
</svg>
</span>

<button class="new-idea-folder-images__button first-button js-hide-add-to-rooms-new-idea-folder-images-btn">
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 495.785 495.785" xml:space="preserve"><path id="XMLID_26_" d="M436.855,90.337L255.175,0.541c-1.62-0.801-3.533-0.707-5.084,0.249c-1.535,0.957-2.467,2.638-2.467,4.449  v36.834H56.017v453.713h105.924V147.996h85.684v36.833c0,1.812,0.932,3.492,2.467,4.449c1.551,0.956,3.464,1.052,5.084,0.249  l181.68-89.796c1.791-0.888,2.914-2.706,2.914-4.698C439.769,93.043,438.646,91.225,436.855,90.337z"></path><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
../ Nice things for glob...
</button>
</div>

<button class="new-idea-folder-images__button back-btn js-hide-add-to-rooms-new-idea-folder-images-btn">
Back
</button>
</div>

<div class="folder-wrapper__saved-elements">
<figure class="folder-wrapper__saved-element add-new-button js-url-modal-btn" data-tab-parrent="#v-pills-basement" data-button-positon="folder-name" data-toggle="modal" data-target="#newImageUrl">
<figcaption class="add-new-button__wrap">

<span class="svg-group">
<span class="svg-group__first">
<svg xmlns="http://www.w3.org/2000/svg" width="34.215" height="51.323" viewBox="0 0 34.215 51.323">
<path id="Path_451" data-name="Path 451" d="M161.684,17.839,146.714.731a2.134,2.134,0,0,0-3.216,0L128.529,17.839a2.137,2.137,0,0,0,1.608,3.546h8.554v27.8a2.139,2.139,0,0,0,2.138,2.138h8.554a2.139,2.139,0,0,0,2.138-2.138v-27.8h8.554a2.137,2.137,0,0,0,1.608-3.546Z" transform="translate(-127.998)" fill="#fff"/>
</svg>
</span>
<span class="svg-group__second">
<svg xmlns="http://www.w3.org/2000/svg" width="21.992" height="9.797" viewBox="0 0 21.992 9.797">
<path id="Path_448" data-name="Path 448" d="M20.286,207.506a1.764,1.764,0,0,0-1.764,1.764v4.5H3.586v-4.5a1.764,1.764,0,0,0-3.528,0v6.269A1.764,1.764,0,0,0,1.822,217.3H20.286a1.764,1.764,0,0,0,1.764-1.764V209.27A1.764,1.764,0,0,0,20.286,207.506Z" transform="translate(-0.058 -207.506)" fill="#fff"/>
</svg>
</span>
</span>

<p class="folder-wrapper__saved-element--folders-text">Add an external URL of image or upload an image from the device</p>
</figcaption>
</figure>
<figure class="folder-wrapper__saved-element">
<img src="<?php echo SITEROOT; ?>images/idea-folder-room-2.png" alt="" class="folder-wrapper__saved-element--img img-fluid">
<figcaption class="folder-wrapper__saved-element--text-box">
<div class="folder-wrapper__saved-element--buttons">
<button class="shere">
<svg xmlns="http://www.w3.org/2000/svg" width="23.547" height="25.688" viewBox="0 0 23.547 25.688"><defs><style>.share-white{fill:#fff;}</style></defs><g transform="translate(0)"><path class="share-white" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"/><path class="share-white" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"/><path class="share-white" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"/><path class="share-white" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"/><path class="share-white" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"/><path class="share-white" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"/><path class="share-white" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"/><path class="share-white" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"/></g></svg>
</button>
<button class="delete" data-toggle="modal" data-target="#deleteFolder">
<svg xmlns="http://www.w3.org/2000/svg" width="14.932" height="16.033" viewBox="0 0 14.932 16.033"><defs><style>.trash-white{fill:#fff;}</style></defs><g transform="translate(0 0)"><g transform="translate(0 0)"><g transform="translate(0 0)"><path class="trash-white" d="M63.331,124.769a1.305,1.305,0,0,0,1.351,1.168h5.771a1.328,1.328,0,0,0,1.374-1.191l.939-9.8H62.186Z" transform="translate(-60.01 -109.905)"/><path class="trash-white" d="M27.028,2.061h-4.26V1.328A1.283,1.283,0,0,0,21.533,0H18.577a1.282,1.282,0,0,0-1.306,1.259q0,.035,0,.07v.733h-4.26a.458.458,0,0,0,0,.916H27.028a.458.458,0,1,0,0-.916Zm-5.176-.733v.733H18.188V1.328a.366.366,0,0,1,.389-.412h2.886a.366.366,0,0,1,.391.34A.362.362,0,0,1,21.852,1.328Z" transform="translate(-12.554 0)"/></g></g></g></svg>
</button>
</div>
<div class="idea-folder-gallery">
<a href="images/idea-folder-room-2.png" title="Lorem ipsum" class="folder-wrapper__saved-element--text">
Preview
</a>
</div>
</figcaption>
</figure>
<figure class="folder-wrapper__saved-element">
<img src="<?php echo SITEROOT; ?>images/idea-folder-room-3.png" alt="" class="folder-wrapper__saved-element--img img-fluid">
<figcaption class="folder-wrapper__saved-element--text-box">
<div class="folder-wrapper__saved-element--buttons">
<button class="shere">
<svg xmlns="http://www.w3.org/2000/svg" width="23.547" height="25.688" viewBox="0 0 23.547 25.688"><defs><style>.share-white{fill:#fff;}</style></defs><g transform="translate(0)"><path class="share-white" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"/><path class="share-white" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"/><path class="share-white" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"/><path class="share-white" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"/><path class="share-white" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"/><path class="share-white" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"/><path class="share-white" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"/><path class="share-white" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"/></g></svg>
</button>
<button class="delete" data-toggle="modal" data-target="#deleteFolder">
<svg xmlns="http://www.w3.org/2000/svg" width="14.932" height="16.033" viewBox="0 0 14.932 16.033"><defs><style>.trash-white{fill:#fff;}</style></defs><g transform="translate(0 0)"><g transform="translate(0 0)"><g transform="translate(0 0)"><path class="trash-white" d="M63.331,124.769a1.305,1.305,0,0,0,1.351,1.168h5.771a1.328,1.328,0,0,0,1.374-1.191l.939-9.8H62.186Z" transform="translate(-60.01 -109.905)"/><path class="trash-white" d="M27.028,2.061h-4.26V1.328A1.283,1.283,0,0,0,21.533,0H18.577a1.282,1.282,0,0,0-1.306,1.259q0,.035,0,.07v.733h-4.26a.458.458,0,0,0,0,.916H27.028a.458.458,0,1,0,0-.916Zm-5.176-.733v.733H18.188V1.328a.366.366,0,0,1,.389-.412h2.886a.366.366,0,0,1,.391.34A.362.362,0,0,1,21.852,1.328Z" transform="translate(-12.554 0)"/></g></g></g></svg>
</button>
</div>
<div class="idea-folder-gallery">
<a href="images/idea-folder-room-3.png" title="Lorem ipsum" class="folder-wrapper__saved-element--text">
Preview
</a>
</div>
</figcaption>
</figure>
<figure class="folder-wrapper__saved-element">
<img src="<?php echo SITEROOT; ?>images/idea-folder-room-4.png" alt="" class="folder-wrapper__saved-element--img img-fluid">
<figcaption class="folder-wrapper__saved-element--text-box">
<div class="folder-wrapper__saved-element--buttons">
<button class="shere">
<svg xmlns="http://www.w3.org/2000/svg" width="23.547" height="25.688" viewBox="0 0 23.547 25.688"><defs><style>.share-white{fill:#fff;}</style></defs><g transform="translate(0)"><path class="share-white" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"/><path class="share-white" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"/><path class="share-white" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"/><path class="share-white" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"/><path class="share-white" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"/><path class="share-white" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"/><path class="share-white" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"/><path class="share-white" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"/></g></svg>
</button>
<button class="delete" data-toggle="modal" data-target="#deleteFolder">
<svg xmlns="http://www.w3.org/2000/svg" width="14.932" height="16.033" viewBox="0 0 14.932 16.033"><defs><style>.trash-white{fill:#fff;}</style></defs><g transform="translate(0 0)"><g transform="translate(0 0)"><g transform="translate(0 0)"><path class="trash-white" d="M63.331,124.769a1.305,1.305,0,0,0,1.351,1.168h5.771a1.328,1.328,0,0,0,1.374-1.191l.939-9.8H62.186Z" transform="translate(-60.01 -109.905)"/><path class="trash-white" d="M27.028,2.061h-4.26V1.328A1.283,1.283,0,0,0,21.533,0H18.577a1.282,1.282,0,0,0-1.306,1.259q0,.035,0,.07v.733h-4.26a.458.458,0,0,0,0,.916H27.028a.458.458,0,1,0,0-.916Zm-5.176-.733v.733H18.188V1.328a.366.366,0,0,1,.389-.412h2.886a.366.366,0,0,1,.391.34A.362.362,0,0,1,21.852,1.328Z" transform="translate(-12.554 0)"/></g></g></g></svg>
</button>
</div>
<div class="idea-folder-gallery">
<a href="images/idea-folder-room-4.png" title="Lorem ipsum" class="folder-wrapper__saved-element--text">
Preview
</a>
</div>
</figcaption>
</figure>
<figure class="folder-wrapper__saved-element">
<img src="<?php echo SITEROOT; ?>images/idea-folder-room-5.png" alt="" class="folder-wrapper__saved-element--img img-fluid">
<figcaption class="folder-wrapper__saved-element--text-box">
<div class="folder-wrapper__saved-element--buttons">
<button class="shere">
<svg xmlns="http://www.w3.org/2000/svg" width="23.547" height="25.688" viewBox="0 0 23.547 25.688"><defs><style>.share-white{fill:#fff;}</style></defs><g transform="translate(0)"><path class="share-white" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"/><path class="share-white" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"/><path class="share-white" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"/><path class="share-white" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"/><path class="share-white" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"/><path class="share-white" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"/><path class="share-white" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"/><path class="share-white" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"/></g></svg>
</button>
<button class="delete" data-toggle="modal" data-target="#deleteFolder">
<svg xmlns="http://www.w3.org/2000/svg" width="14.932" height="16.033" viewBox="0 0 14.932 16.033"><defs><style>.trash-white{fill:#fff;}</style></defs><g transform="translate(0 0)"><g transform="translate(0 0)"><g transform="translate(0 0)"><path class="trash-white" d="M63.331,124.769a1.305,1.305,0,0,0,1.351,1.168h5.771a1.328,1.328,0,0,0,1.374-1.191l.939-9.8H62.186Z" transform="translate(-60.01 -109.905)"/><path class="trash-white" d="M27.028,2.061h-4.26V1.328A1.283,1.283,0,0,0,21.533,0H18.577a1.282,1.282,0,0,0-1.306,1.259q0,.035,0,.07v.733h-4.26a.458.458,0,0,0,0,.916H27.028a.458.458,0,1,0,0-.916Zm-5.176-.733v.733H18.188V1.328a.366.366,0,0,1,.389-.412h2.886a.366.366,0,0,1,.391.34A.362.362,0,0,1,21.852,1.328Z" transform="translate(-12.554 0)"/></g></g></g></svg>
</button>
</div>
<div class="idea-folder-gallery">
<a href="images/idea-folder-room-5.png" title="Lorem ipsum"  class="folder-wrapper__saved-element--text">
Preview
</a>
</div>
</figcaption>
</figure>
</div>
</div>
</div>
</div>
</div>
</div>


<div class="tab-pane fade" id="v-pills-home-office" role="tabpanel" aria-labelledby="v-pills-home-office-tab">
<div class="folder-wrapper">
<div class="desktop-show">
<div class="row mb-2">
<div class="col-8">
<h3 class="folder-wrapper__heading">Title house name 1 - Home Office</h3>
</div>
</div>
</div>
<div class="row">
<div class="col-12 js-saved-images-box">
<div class="new-idea-folder-images__wrapper">
<div class="new-idea-folder-images__buttons">

<p class="new-idea-folder-images__empty-text">
No saved files in Home Office!
</p>
</div>

<div class="mb-2">
<p class="idea-folder-empty-house__text">You can add them from our website or by adding external images by choosing the option below</p>
</div>

<div class="folder-wrapper__saved-elements">
<figure class="folder-wrapper__saved-element specification-sheet">
<figcaption class="folder-wrapper__saved-element--folders">
<span class="folder-wrapper__saved-element--folders-img">
<svg xmlns="http://www.w3.org/2000/svg" width="24.704" height="16.27" viewBox="0 0 24.704 16.27">
<g id="open-folder-black-and-white-variant" transform="translate(0 -87.578)">
<path id="Path_434" data-name="Path 434" d="M18.618,102.844a1.7,1.7,0,0,0,1.429-.84l4.57-8.648c.273-.526-.124-.84-.84-.84H19.163V90.451a1.3,1.3,0,0,0-1.293-1.293H6.573l-.838-2.2a.59.59,0,0,0-.551-.38H.6a.589.589,0,0,0-.59.593l.011,3.28L0,101.554a1.3,1.3,0,0,0,1.293,1.293m16.69-10.33H7.922a1.392,1.392,0,0,0-1.134.84l-4.109,8.311H1.293a.114.114,0,0,1-.114-.114v-13.8h3.6l.838,2.2a.59.59,0,0,0,.551.38h11.7a.114.114,0,0,1,.114.114v2.066Z" transform="translate(0 1)" fill="#fff"/>
</g>
</svg>
</span>
<div class="folder-wrapper__saved-element--buttons">
<button class="shere">
<svg xmlns="http://www.w3.org/2000/svg" width="23.547" height="25.688" viewBox="0 0 23.547 25.688"><defs><style>.share-white{fill:#fff;}</style></defs><g transform="translate(0)"><path class="share-white" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"/><path class="share-white" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"/><path class="share-white" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"/><path class="share-white" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"/><path class="share-white" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"/><path class="share-white" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"/><path class="share-white" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"/><path class="share-white" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"/></g></svg>
</button>
<button class="delete" data-toggle="modal" data-target="#deleteFolder">
<svg xmlns="http://www.w3.org/2000/svg" width="14.932" height="16.033" viewBox="0 0 14.932 16.033"><defs><style>.trash-white{fill:#fff;}</style></defs><g transform="translate(0 0)"><g transform="translate(0 0)"><g transform="translate(0 0)"><path class="trash-white" d="M63.331,124.769a1.305,1.305,0,0,0,1.351,1.168h5.771a1.328,1.328,0,0,0,1.374-1.191l.939-9.8H62.186Z" transform="translate(-60.01 -109.905)"/><path class="trash-white" d="M27.028,2.061h-4.26V1.328A1.283,1.283,0,0,0,21.533,0H18.577a1.282,1.282,0,0,0-1.306,1.259q0,.035,0,.07v.733h-4.26a.458.458,0,0,0,0,.916H27.028a.458.458,0,1,0,0-.916Zm-5.176-.733v.733H18.188V1.328a.366.366,0,0,1,.389-.412h2.886a.366.366,0,0,1,.391.34A.362.362,0,0,1,21.852,1.328Z" transform="translate(-12.554 0)"/></g></g></g></svg>
</button>
</div>
<p class="folder-wrapper__saved-element--text first">Specification sheet</p>
<button class="folder-wrapper__saved-element--folders-button"><span onClick="open_specs();">open folder</span></button>
</figcaption>
</figure>
<figure class="folder-wrapper__saved-element folders">
<figcaption class="folder-wrapper__saved-element--folders">
<span class="folder-wrapper__saved-element--folders-img">
<svg xmlns="http://www.w3.org/2000/svg" width="86" height="71.044" viewBox="0 0 86 71.044"><defs><style>.folder-orange{fill:#edb700;}</style></defs><g transform="translate(-10.667)"><g transform="translate(10.667 7.478)"><g transform="translate(0)"><path class="folder-orange" d="M87.319,53.884H44.1a5.6,5.6,0,0,1-5.321-3.836l-.329-.991a9.337,9.337,0,0,0-8.865-6.39H20.015a9.361,9.361,0,0,0-9.348,9.348v44.87a9.358,9.358,0,0,0,9.348,9.348H34.971a1.87,1.87,0,1,0,0-3.739H20.015a5.615,5.615,0,0,1-5.609-5.609V52.015a5.615,5.615,0,0,1,5.609-5.609h9.568A5.6,5.6,0,0,1,34.9,50.239l.333.995a9.337,9.337,0,0,0,8.865,6.39H87.319a5.615,5.615,0,0,1,5.609,5.609V96.884a5.615,5.615,0,0,1-5.609,5.609H72.363a1.87,1.87,0,0,0,0,3.739H87.319a9.356,9.356,0,0,0,9.348-9.348V63.232A9.358,9.358,0,0,0,87.319,53.884Z" transform="translate(-10.667 -42.667)"/></g></g><g transform="translate(14.406)"><path class="folder-orange" d="M101.174,0H41.348A9.361,9.361,0,0,0,32,9.348a1.87,1.87,0,0,0,3.739,0,5.615,5.615,0,0,1,5.609-5.609h59.826a5.615,5.615,0,0,1,5.609,5.609V20.565a1.87,1.87,0,1,0,3.739,0V9.348A9.359,9.359,0,0,0,101.174,0Z" transform="translate(-32)"/></g></g></svg>
</span>
<p class="folder-wrapper__saved-element--folders-text">Nice things for living room</p>
<button class="folder-wrapper__saved-element--folders-button js-show-add-to-rooms-new-idea-folder-images-btn">View folder</button>
</figcaption>
</figure>
<figure class="folder-wrapper__saved-element add-new-button js-url-modal-btn" data-tab-parrent="#v-pills-home-office" data-button-positon="room-name" data-toggle="modal" data-target="#newImageUrl">
<figcaption class="add-new-button__wrap">

<span class="svg-group">
<span class="svg-group__first">
<svg xmlns="http://www.w3.org/2000/svg" width="34.215" height="51.323" viewBox="0 0 34.215 51.323">
<path id="Path_451" data-name="Path 451" d="M161.684,17.839,146.714.731a2.134,2.134,0,0,0-3.216,0L128.529,17.839a2.137,2.137,0,0,0,1.608,3.546h8.554v27.8a2.139,2.139,0,0,0,2.138,2.138h8.554a2.139,2.139,0,0,0,2.138-2.138v-27.8h8.554a2.137,2.137,0,0,0,1.608-3.546Z" transform="translate(-127.998)" fill="#fff"/>
</svg>
</span>
<span class="svg-group__second">
<svg xmlns="http://www.w3.org/2000/svg" width="21.992" height="9.797" viewBox="0 0 21.992 9.797">
<path id="Path_448" data-name="Path 448" d="M20.286,207.506a1.764,1.764,0,0,0-1.764,1.764v4.5H3.586v-4.5a1.764,1.764,0,0,0-3.528,0v6.269A1.764,1.764,0,0,0,1.822,217.3H20.286a1.764,1.764,0,0,0,1.764-1.764V209.27A1.764,1.764,0,0,0,20.286,207.506Z" transform="translate(-0.058 -207.506)" fill="#fff"/>
</svg>
</span>
</span>

<p class="folder-wrapper__saved-element--folders-text">Add an external URL of image or upload an image from the device</p>
</figcaption>
</figure>
</div>
</div>
</div>

<div class="col-12 js-specification-sheet-box" style="display: none;">
<div class="folder-wrapper__specification-sheet--wrapper">

<div class="folder-wrapper__specification-sheet--buttons-box">

<div class="folder-wrapper__specification-sheet--buttons-box-content">
<span class="folder-wrapper__specification-sheet--buttons-box-image">
<svg xmlns="http://www.w3.org/2000/svg" width="24.704" height="16.27" viewBox="0 0 24.704 16.27">
<g id="open-folder-black-and-white-variant" transform="translate(0 -87.578)">
<path id="Path_434" data-name="Path 434" d="M18.618,102.844a1.7,1.7,0,0,0,1.429-.84l4.57-8.648c.273-.526-.124-.84-.84-.84H19.163V90.451a1.3,1.3,0,0,0-1.293-1.293H6.573l-.838-2.2a.59.59,0,0,0-.551-.38H.6a.589.589,0,0,0-.59.593l.011,3.28L0,101.554a1.3,1.3,0,0,0,1.293,1.293m16.69-10.33H7.922a1.392,1.392,0,0,0-1.134.84l-4.109,8.311H1.293a.114.114,0,0,1-.114-.114v-13.8h3.6l.838,2.2a.59.59,0,0,0,.551.38h11.7a.114.114,0,0,1,.114.114v2.066Z" transform="translate(0 1)" fill="#fff"/>
</g>
</svg>
</span>

<button class="folder-wrapper__specification-sheet--button js-hide-specification-sheet-box-btn">
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 495.785 495.785" xml:space="preserve"><path id="XMLID_26_" d="M436.855,90.337L255.175,0.541c-1.62-0.801-3.533-0.707-5.084,0.249c-1.535,0.957-2.467,2.638-2.467,4.449  v36.834H56.017v453.713h105.924V147.996h85.684v36.833c0,1.812,0.932,3.492,2.467,4.449c1.551,0.956,3.464,1.052,5.084,0.249  l181.68-89.796c1.791-0.888,2.914-2.706,2.914-4.698C439.769,93.043,438.646,91.225,436.855,90.337z"/><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
../ Specification sheet
</button>
</div>

<div class="d-flex justify-content-center align-items-center">
<div class="house-checkbox">
<input class="custom-checkbox js-load-confirm-modal" id="checkbox-12" type="checkbox" value="value12" data-target="#confirmModal">
<label for="checkbox-12">Share with Closets To Go</label>
</div>

<button class="folder-wrapper__specification-sheet--button second-button js-hide-specification-sheet-box-btn">
Back
</button>
</div>
</div>

<div class="mt-2 mb-2">
<p class="idea-folder-empty-house__heading">No saved files in 'Nice things for Guest Room folder!</p>
<p class="idea-folder-empty-house__text">You can add them from our website or by adding external images by choosing the option below</p>
</div>

</div>
</div>

<div class="col-12 js-add-to-rooms-new-idea-folder-images" style="display: none;">
<div class="new-idea-folder-images__wrapper">

<div class="new-idea-folder-images__buttons">

<div class="new-idea-folder-images__buttons-box-content">
<span class="new-idea-folder-images__buttons-box-image">
<svg xmlns="http://www.w3.org/2000/svg" width="24.704" height="16.27" viewBox="0 0 24.704 16.27">
<g id="open-folder-black-and-white-variant" transform="translate(0 -87.578)">
<path id="Path_434" data-name="Path 434" d="M18.618,102.844a1.7,1.7,0,0,0,1.429-.84l4.57-8.648c.273-.526-.124-.84-.84-.84H19.163V90.451a1.3,1.3,0,0,0-1.293-1.293H6.573l-.838-2.2a.59.59,0,0,0-.551-.38H.6a.589.589,0,0,0-.59.593l.011,3.28L0,101.554a1.3,1.3,0,0,0,1.293,1.293m16.69-10.33H7.922a1.392,1.392,0,0,0-1.134.84l-4.109,8.311H1.293a.114.114,0,0,1-.114-.114v-13.8h3.6l.838,2.2a.59.59,0,0,0,.551.38h11.7a.114.114,0,0,1,.114.114v2.066Z" transform="translate(0 1)" fill="#fff"></path>
</g>
</svg>
</span>

<button class="new-idea-folder-images__button first-button js-hide-add-to-rooms-new-idea-folder-images-btn">
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 495.785 495.785" xml:space="preserve"><path id="XMLID_26_" d="M436.855,90.337L255.175,0.541c-1.62-0.801-3.533-0.707-5.084,0.249c-1.535,0.957-2.467,2.638-2.467,4.449  v36.834H56.017v453.713h105.924V147.996h85.684v36.833c0,1.812,0.932,3.492,2.467,4.449c1.551,0.956,3.464,1.052,5.084,0.249  l181.68-89.796c1.791-0.888,2.914-2.706,2.914-4.698C439.769,93.043,438.646,91.225,436.855,90.337z"></path><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
../ Nice things for glob...
</button>
</div>

<button class="new-idea-folder-images__button back-btn js-hide-add-to-rooms-new-idea-folder-images-btn">
Back
</button>
</div>

<div class="mt-2 mb-2">
<p class="idea-folder-empty-house__heading">No saved files in 'Nice things for Guest Room folder!</p>
<p class="idea-folder-empty-house__text">You can add them from our website or by adding external images by choosing the option below</p>
</div>

<div class="folder-wrapper__saved-elements">
<figure class="folder-wrapper__saved-element add-new-button js-url-modal-btn" data-tab-parrent="#v-pills-home-office" data-button-positon="folder-name" data-toggle="modal" data-target="#newImageUrl">
<figcaption class="add-new-button__wrap">
<span class="svg-group">
<span class="svg-group__first">
<svg xmlns="http://www.w3.org/2000/svg" width="34.215" height="51.323" viewBox="0 0 34.215 51.323">
<path id="Path_451" data-name="Path 451" d="M161.684,17.839,146.714.731a2.134,2.134,0,0,0-3.216,0L128.529,17.839a2.137,2.137,0,0,0,1.608,3.546h8.554v27.8a2.139,2.139,0,0,0,2.138,2.138h8.554a2.139,2.139,0,0,0,2.138-2.138v-27.8h8.554a2.137,2.137,0,0,0,1.608-3.546Z" transform="translate(-127.998)" fill="#fff"/>
</svg>
</span>
<span class="svg-group__second">
<svg xmlns="http://www.w3.org/2000/svg" width="21.992" height="9.797" viewBox="0 0 21.992 9.797">
<path id="Path_448" data-name="Path 448" d="M20.286,207.506a1.764,1.764,0,0,0-1.764,1.764v4.5H3.586v-4.5a1.764,1.764,0,0,0-3.528,0v6.269A1.764,1.764,0,0,0,1.822,217.3H20.286a1.764,1.764,0,0,0,1.764-1.764V209.27A1.764,1.764,0,0,0,20.286,207.506Z" transform="translate(-0.058 -207.506)" fill="#fff"/>
</svg>
</span>
</span>

<p class="folder-wrapper__saved-element--folders-text">Add an external URL of image or upload an image from the device</p>
</figcaption>
</figure>
</div>
</div>
</div>
</div>
</div>
</div>


<div class="tab-pane fade" id="v-pills-nursery" role="tabpanel" aria-labelledby="v-pills-nursery-tab">
<div class="folder-wrapper">
<div class="desktop-show">
<div class="row mb-2">
<div class="col-8">
<h3 class="folder-wrapper__heading">Title house name 1 - Nursery</h3>
</div>
</div>
</div>
<div class="row">
<div class="col-12 js-saved-images-box">
<div class="new-idea-folder-images__wrapper">
<div class="new-idea-folder-images__buttons">
<p class="new-idea-folder-images__empty-text">
No saved files in Nursery!
</p>
</div>
<div class="mb-2">
<p class="idea-folder-empty-house__text">You can add them from our website or by adding external images by choosing the option below</p>
</div>
<div class="folder-wrapper__saved-elements">
<figure class="folder-wrapper__saved-element specification-sheet">
<figcaption class="folder-wrapper__saved-element--folders">
<span class="folder-wrapper__saved-element--folders-img">
<svg xmlns="http://www.w3.org/2000/svg" width="24.704" height="16.27" viewBox="0 0 24.704 16.27">
<g id="open-folder-black-and-white-variant" transform="translate(0 -87.578)">
<path id="Path_434" data-name="Path 434" d="M18.618,102.844a1.7,1.7,0,0,0,1.429-.84l4.57-8.648c.273-.526-.124-.84-.84-.84H19.163V90.451a1.3,1.3,0,0,0-1.293-1.293H6.573l-.838-2.2a.59.59,0,0,0-.551-.38H.6a.589.589,0,0,0-.59.593l.011,3.28L0,101.554a1.3,1.3,0,0,0,1.293,1.293m16.69-10.33H7.922a1.392,1.392,0,0,0-1.134.84l-4.109,8.311H1.293a.114.114,0,0,1-.114-.114v-13.8h3.6l.838,2.2a.59.59,0,0,0,.551.38h11.7a.114.114,0,0,1,.114.114v2.066Z" transform="translate(0 1)" fill="#fff"/>
</g>
</svg>
</span>
<div class="folder-wrapper__saved-element--buttons">
<button class="shere">
<svg xmlns="http://www.w3.org/2000/svg" width="23.547" height="25.688" viewBox="0 0 23.547 25.688"><defs><style>.share-white{fill:#fff;}</style></defs><g transform="translate(0)"><path class="share-white" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"/><path class="share-white" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"/><path class="share-white" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"/><path class="share-white" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"/><path class="share-white" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"/><path class="share-white" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"/><path class="share-white" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"/><path class="share-white" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"/></g></svg>
</button>
<button class="delete" data-toggle="modal" data-target="#deleteFolder">
<svg xmlns="http://www.w3.org/2000/svg" width="14.932" height="16.033" viewBox="0 0 14.932 16.033"><defs><style>.trash-white{fill:#fff;}</style></defs><g transform="translate(0 0)"><g transform="translate(0 0)"><g transform="translate(0 0)"><path class="trash-white" d="M63.331,124.769a1.305,1.305,0,0,0,1.351,1.168h5.771a1.328,1.328,0,0,0,1.374-1.191l.939-9.8H62.186Z" transform="translate(-60.01 -109.905)"/><path class="trash-white" d="M27.028,2.061h-4.26V1.328A1.283,1.283,0,0,0,21.533,0H18.577a1.282,1.282,0,0,0-1.306,1.259q0,.035,0,.07v.733h-4.26a.458.458,0,0,0,0,.916H27.028a.458.458,0,1,0,0-.916Zm-5.176-.733v.733H18.188V1.328a.366.366,0,0,1,.389-.412h2.886a.366.366,0,0,1,.391.34A.362.362,0,0,1,21.852,1.328Z" transform="translate(-12.554 0)"/></g></g></g></svg>
</button>
</div>
<p class="folder-wrapper__saved-element--text first">Specification sheet</p>
<button class="folder-wrapper__saved-element--folders-button"><span onClick="open_specs();">open folder</span></button>
</figcaption>
</figure>
<figure class="folder-wrapper__saved-element folders">
<figcaption class="folder-wrapper__saved-element--folders">
<span class="folder-wrapper__saved-element--folders-img">
Nursery	<svg xmlns="http://www.w3.org/2000/svg" width="86" height="71.044" viewBox="0 0 86 71.044"><defs><style>.folder-orange{fill:#edb700;}</style></defs><g transform="translate(-10.667)"><g transform="translate(10.667 7.478)"><g transform="translate(0)"><path class="folder-orange" d="M87.319,53.884H44.1a5.6,5.6,0,0,1-5.321-3.836l-.329-.991a9.337,9.337,0,0,0-8.865-6.39H20.015a9.361,9.361,0,0,0-9.348,9.348v44.87a9.358,9.358,0,0,0,9.348,9.348H34.971a1.87,1.87,0,1,0,0-3.739H20.015a5.615,5.615,0,0,1-5.609-5.609V52.015a5.615,5.615,0,0,1,5.609-5.609h9.568A5.6,5.6,0,0,1,34.9,50.239l.333.995a9.337,9.337,0,0,0,8.865,6.39H87.319a5.615,5.615,0,0,1,5.609,5.609V96.884a5.615,5.615,0,0,1-5.609,5.609H72.363a1.87,1.87,0,0,0,0,3.739H87.319a9.356,9.356,0,0,0,9.348-9.348V63.232A9.358,9.358,0,0,0,87.319,53.884Z" transform="translate(-10.667 -42.667)"/></g></g><g transform="translate(14.406)"><path class="folder-orange" d="M101.174,0H41.348A9.361,9.361,0,0,0,32,9.348a1.87,1.87,0,0,0,3.739,0,5.615,5.615,0,0,1,5.609-5.609h59.826a5.615,5.615,0,0,1,5.609,5.609V20.565a1.87,1.87,0,1,0,3.739,0V9.348A9.359,9.359,0,0,0,101.174,0Z" transform="translate(-32)"/></g></g></svg>
</span>
<p class="folder-wrapper__saved-element--folders-text">Nice things for living room</p>
<button class="folder-wrapper__saved-element--folders-button js-show-add-to-rooms-new-idea-folder-images-btn">View folder</button>
</figcaption>
</figure>
<figure class="folder-wrapper__saved-element add-new-button js-url-modal-btn" data-tab-parrent="#v-pills-nursery" data-button-positon="room-name" data-toggle="modal" data-target="#newImageUrl">
<figcaption class="add-new-button__wrap">
<span class="svg-group">
<span class="svg-group__first">
<svg xmlns="http://www.w3.org/2000/svg" width="34.215" height="51.323" viewBox="0 0 34.215 51.323">
<path id="Path_451" data-name="Path 451" d="M161.684,17.839,146.714.731a2.134,2.134,0,0,0-3.216,0L128.529,17.839a2.137,2.137,0,0,0,1.608,3.546h8.554v27.8a2.139,2.139,0,0,0,2.138,2.138h8.554a2.139,2.139,0,0,0,2.138-2.138v-27.8h8.554a2.137,2.137,0,0,0,1.608-3.546Z" transform="translate(-127.998)" fill="#fff"/>
</svg>
</span>
<span class="svg-group__second">
<svg xmlns="http://www.w3.org/2000/svg" width="21.992" height="9.797" viewBox="0 0 21.992 9.797">
<path id="Path_448" data-name="Path 448" d="M20.286,207.506a1.764,1.764,0,0,0-1.764,1.764v4.5H3.586v-4.5a1.764,1.764,0,0,0-3.528,0v6.269A1.764,1.764,0,0,0,1.822,217.3H20.286a1.764,1.764,0,0,0,1.764-1.764V209.27A1.764,1.764,0,0,0,20.286,207.506Z" transform="translate(-0.058 -207.506)" fill="#fff"/>
</svg>
</span>
</span>
<p class="folder-wrapper__saved-element--folders-text">Add an external URL of image or upload an image from the device</p>
</figcaption>
</figure>
</div>
</div>
</div>


<div class="col-12 js-specification-sheet-box" style="display: none;">
<div class="folder-wrapper__specification-sheet--wrapper">
<div class="folder-wrapper__specification-sheet--buttons-box">
<div class="folder-wrapper__specification-sheet--buttons-box-content">
<span class="folder-wrapper__specification-sheet--buttons-box-image">
<svg xmlns="http://www.w3.org/2000/svg" width="24.704" height="16.27" viewBox="0 0 24.704 16.27">
<g id="open-folder-black-and-white-variant" transform="translate(0 -87.578)">
<path id="Path_434" data-name="Path 434" d="M18.618,102.844a1.7,1.7,0,0,0,1.429-.84l4.57-8.648c.273-.526-.124-.84-.84-.84H19.163V90.451a1.3,1.3,0,0,0-1.293-1.293H6.573l-.838-2.2a.59.59,0,0,0-.551-.38H.6a.589.589,0,0,0-.59.593l.011,3.28L0,101.554a1.3,1.3,0,0,0,1.293,1.293m16.69-10.33H7.922a1.392,1.392,0,0,0-1.134.84l-4.109,8.311H1.293a.114.114,0,0,1-.114-.114v-13.8h3.6l.838,2.2a.59.59,0,0,0,.551.38h11.7a.114.114,0,0,1,.114.114v2.066Z" transform="translate(0 1)" fill="#fff"/>
</g>
</svg>
</span>
<button class="folder-wrapper__specification-sheet--button js-hide-specification-sheet-box-btn">
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 495.785 495.785" xml:space="preserve"><path id="XMLID_26_" d="M436.855,90.337L255.175,0.541c-1.62-0.801-3.533-0.707-5.084,0.249c-1.535,0.957-2.467,2.638-2.467,4.449  v36.834H56.017v453.713h105.924V147.996h85.684v36.833c0,1.812,0.932,3.492,2.467,4.449c1.551,0.956,3.464,1.052,5.084,0.249  l181.68-89.796c1.791-0.888,2.914-2.706,2.914-4.698C439.769,93.043,438.646,91.225,436.855,90.337z"/><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
../ Specification sheet
</button>
</div>

<div class="d-flex justify-content-center align-items-center">
<div class="house-checkbox">
<input class="custom-checkbox js-load-confirm-modal" id="checkbox-13" type="checkbox" value="value13" data-target="#confirmModal">
<label for="checkbox-13">Share with Closets To Go</label>
</div>

<button class="folder-wrapper__specification-sheet--button second-button js-hide-specification-sheet-box-btn">
Back
</button>
</div>
</div>

<div class="mt-2 mb-2">
<p class="idea-folder-empty-house__heading">No saved files in 'Nice things for Guest Room folder!</p>
<p class="idea-folder-empty-house__text">You can add them from our website or by adding external images by choosing the option below</p>
</div>

</div>
</div>

<div class="col-12 js-add-to-rooms-new-idea-folder-images" style="display: none;">
<div class="new-idea-folder-images__wrapper">

<div class="new-idea-folder-images__buttons">

<div class="new-idea-folder-images__buttons-box-content">
<span class="new-idea-folder-images__buttons-box-image">
<svg xmlns="http://www.w3.org/2000/svg" width="24.704" height="16.27" viewBox="0 0 24.704 16.27">
<g id="open-folder-black-and-white-variant" transform="translate(0 -87.578)">
<path id="Path_434" data-name="Path 434" d="M18.618,102.844a1.7,1.7,0,0,0,1.429-.84l4.57-8.648c.273-.526-.124-.84-.84-.84H19.163V90.451a1.3,1.3,0,0,0-1.293-1.293H6.573l-.838-2.2a.59.59,0,0,0-.551-.38H.6a.589.589,0,0,0-.59.593l.011,3.28L0,101.554a1.3,1.3,0,0,0,1.293,1.293m16.69-10.33H7.922a1.392,1.392,0,0,0-1.134.84l-4.109,8.311H1.293a.114.114,0,0,1-.114-.114v-13.8h3.6l.838,2.2a.59.59,0,0,0,.551.38h11.7a.114.114,0,0,1,.114.114v2.066Z" transform="translate(0 1)" fill="#fff"></path>
</g>
</svg>
</span>

<button class="new-idea-folder-images__button first-button js-hide-add-to-rooms-new-idea-folder-images-btn">
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 495.785 495.785" xml:space="preserve"><path id="XMLID_26_" d="M436.855,90.337L255.175,0.541c-1.62-0.801-3.533-0.707-5.084,0.249c-1.535,0.957-2.467,2.638-2.467,4.449  v36.834H56.017v453.713h105.924V147.996h85.684v36.833c0,1.812,0.932,3.492,2.467,4.449c1.551,0.956,3.464,1.052,5.084,0.249  l181.68-89.796c1.791-0.888,2.914-2.706,2.914-4.698C439.769,93.043,438.646,91.225,436.855,90.337z"></path><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
../ Nice things for glob...
</button>
</div>

<button class="new-idea-folder-images__button back-btn js-hide-add-to-rooms-new-idea-folder-images-btn">
Back
</button>
</div>

<div class="mt-2 mb-2">
<p class="idea-folder-empty-house__heading">No saved files in 'Nice things for Guest Room folder!</p>
<p class="idea-folder-empty-house__text">You can add them from our website or by adding external images by choosing the option below</p>
</div>

<div class="folder-wrapper__saved-elements">
<figure class="folder-wrapper__saved-element add-new-button js-url-modal-btn" data-tab-parrent="#v-pills-nursery" data-button-positon="folder-name" data-toggle="modal" data-target="#newImageUrl">
<figcaption class="add-new-button__wrap">
<span class="svg-group">
<span class="svg-group__first">
<svg xmlns="http://www.w3.org/2000/svg" width="34.215" height="51.323" viewBox="0 0 34.215 51.323">
<path id="Path_451" data-name="Path 451" d="M161.684,17.839,146.714.731a2.134,2.134,0,0,0-3.216,0L128.529,17.839a2.137,2.137,0,0,0,1.608,3.546h8.554v27.8a2.139,2.139,0,0,0,2.138,2.138h8.554a2.139,2.139,0,0,0,2.138-2.138v-27.8h8.554a2.137,2.137,0,0,0,1.608-3.546Z" transform="translate(-127.998)" fill="#fff"/>
</svg>
</span>
<span class="svg-group__second">
<svg xmlns="http://www.w3.org/2000/svg" width="21.992" height="9.797" viewBox="0 0 21.992 9.797">
<path id="Path_448" data-name="Path 448" d="M20.286,207.506a1.764,1.764,0,0,0-1.764,1.764v4.5H3.586v-4.5a1.764,1.764,0,0,0-3.528,0v6.269A1.764,1.764,0,0,0,1.822,217.3H20.286a1.764,1.764,0,0,0,1.764-1.764V209.27A1.764,1.764,0,0,0,20.286,207.506Z" transform="translate(-0.058 -207.506)" fill="#fff"/>
</svg>
</span>
</span>

<p class="folder-wrapper__saved-element--folders-text">Add an external URL of image or upload an image from the device</p>
</figcaption>
</figure>
</div>
</div>
</div>
</div>
</div>
</div>


<div class="tab-pane fade" id="v-pills-playroom" role="tabpanel" aria-labelledby="v-pills-playroom-tab">
<div class="folder-wrapper">
<div class="desktop-show">
<div class="row mb-2">
<div class="col-8">
<h3 class="folder-wrapper__heading">Title house name 1 - Playroom</h3>
</div>
</div>
</div>
<div class="row">
<div class="col-12 js-saved-images-box">
<div class="new-idea-folder-images__wrapper">
<div class="new-idea-folder-images__buttons">

<p class="new-idea-folder-images__empty-text">
No saved files in Playroom!
</p>
</div>

<div class="mb-2">
<p class="idea-folder-empty-house__text">You can add them from our website or by adding external images by choosing the option below</p>
</div>

<div class="folder-wrapper__saved-elements">
<figure class="folder-wrapper__saved-element specification-sheet">
<figcaption class="folder-wrapper__saved-element--folders">
<span class="folder-wrapper__saved-element--folders-img">
<svg xmlns="http://www.w3.org/2000/svg" width="24.704" height="16.27" viewBox="0 0 24.704 16.27">
<g id="open-folder-black-and-white-variant" transform="translate(0 -87.578)">
<path id="Path_434" data-name="Path 434" d="M18.618,102.844a1.7,1.7,0,0,0,1.429-.84l4.57-8.648c.273-.526-.124-.84-.84-.84H19.163V90.451a1.3,1.3,0,0,0-1.293-1.293H6.573l-.838-2.2a.59.59,0,0,0-.551-.38H.6a.589.589,0,0,0-.59.593l.011,3.28L0,101.554a1.3,1.3,0,0,0,1.293,1.293m16.69-10.33H7.922a1.392,1.392,0,0,0-1.134.84l-4.109,8.311H1.293a.114.114,0,0,1-.114-.114v-13.8h3.6l.838,2.2a.59.59,0,0,0,.551.38h11.7a.114.114,0,0,1,.114.114v2.066Z" transform="translate(0 1)" fill="#fff"/>
</g>
</svg>
</span>
<div class="folder-wrapper__saved-element--buttons">
<button class="shere">
<svg xmlns="http://www.w3.org/2000/svg" width="23.547" height="25.688" viewBox="0 0 23.547 25.688"><defs><style>.share-white{fill:#fff;}</style></defs><g transform="translate(0)"><path class="share-white" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"/><path class="share-white" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"/><path class="share-white" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"/><path class="share-white" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"/><path class="share-white" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"/><path class="share-white" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"/><path class="share-white" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"/><path class="share-white" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"/></g></svg>
</button>
<button class="delete" data-toggle="modal" data-target="#deleteFolder">
<svg xmlns="http://www.w3.org/2000/svg" width="14.932" height="16.033" viewBox="0 0 14.932 16.033"><defs><style>.trash-white{fill:#fff;}</style></defs><g transform="translate(0 0)"><g transform="translate(0 0)"><g transform="translate(0 0)"><path class="trash-white" d="M63.331,124.769a1.305,1.305,0,0,0,1.351,1.168h5.771a1.328,1.328,0,0,0,1.374-1.191l.939-9.8H62.186Z" transform="translate(-60.01 -109.905)"/><path class="trash-white" d="M27.028,2.061h-4.26V1.328A1.283,1.283,0,0,0,21.533,0H18.577a1.282,1.282,0,0,0-1.306,1.259q0,.035,0,.07v.733h-4.26a.458.458,0,0,0,0,.916H27.028a.458.458,0,1,0,0-.916Zm-5.176-.733v.733H18.188V1.328a.366.366,0,0,1,.389-.412h2.886a.366.366,0,0,1,.391.34A.362.362,0,0,1,21.852,1.328Z" transform="translate(-12.554 0)"/></g></g></g></svg>
</button>
</div>
<p class="folder-wrapper__saved-element--text first">Specification sheet</p>
<button class="folder-wrapper__saved-element--folders-button"><span onClick="open_specs();">open folder</span></button>
</figcaption>
</figure>
<figure class="folder-wrapper__saved-element folders">
<figcaption class="folder-wrapper__saved-element--folders">
<span class="folder-wrapper__saved-element--folders-img">
<svg xmlns="http://www.w3.org/2000/svg" width="86" height="71.044" viewBox="0 0 86 71.044"><defs><style>.folder-orange{fill:#edb700;}</style></defs><g transform="translate(-10.667)"><g transform="translate(10.667 7.478)"><g transform="translate(0)"><path class="folder-orange" d="M87.319,53.884H44.1a5.6,5.6,0,0,1-5.321-3.836l-.329-.991a9.337,9.337,0,0,0-8.865-6.39H20.015a9.361,9.361,0,0,0-9.348,9.348v44.87a9.358,9.358,0,0,0,9.348,9.348H34.971a1.87,1.87,0,1,0,0-3.739H20.015a5.615,5.615,0,0,1-5.609-5.609V52.015a5.615,5.615,0,0,1,5.609-5.609h9.568A5.6,5.6,0,0,1,34.9,50.239l.333.995a9.337,9.337,0,0,0,8.865,6.39H87.319a5.615,5.615,0,0,1,5.609,5.609V96.884a5.615,5.615,0,0,1-5.609,5.609H72.363a1.87,1.87,0,0,0,0,3.739H87.319a9.356,9.356,0,0,0,9.348-9.348V63.232A9.358,9.358,0,0,0,87.319,53.884Z" transform="translate(-10.667 -42.667)"/></g></g><g transform="translate(14.406)"><path class="folder-orange" d="M101.174,0H41.348A9.361,9.361,0,0,0,32,9.348a1.87,1.87,0,0,0,3.739,0,5.615,5.615,0,0,1,5.609-5.609h59.826a5.615,5.615,0,0,1,5.609,5.609V20.565a1.87,1.87,0,1,0,3.739,0V9.348A9.359,9.359,0,0,0,101.174,0Z" transform="translate(-32)"/></g></g></svg>
</span>
<p class="folder-wrapper__saved-element--folders-text">Nice things for living room</p>
<button class="folder-wrapper__saved-element--folders-button js-show-add-to-rooms-new-idea-folder-images-btn">View folder</button>
</figcaption>
</figure>
<figure class="folder-wrapper__saved-element add-new-button js-url-modal-btn" data-tab-parrent="#v-pills-playroom" data-button-positon="room-name" data-toggle="modal" data-target="#newImageUrl">
<figcaption class="add-new-button__wrap">

<span class="svg-group">
<span class="svg-group__first">
<svg xmlns="http://www.w3.org/2000/svg" width="34.215" height="51.323" viewBox="0 0 34.215 51.323">
<path id="Path_451" data-name="Path 451" d="M161.684,17.839,146.714.731a2.134,2.134,0,0,0-3.216,0L128.529,17.839a2.137,2.137,0,0,0,1.608,3.546h8.554v27.8a2.139,2.139,0,0,0,2.138,2.138h8.554a2.139,2.139,0,0,0,2.138-2.138v-27.8h8.554a2.137,2.137,0,0,0,1.608-3.546Z" transform="translate(-127.998)" fill="#fff"/>
</svg>
</span>
<span class="svg-group__second">
<svg xmlns="http://www.w3.org/2000/svg" width="21.992" height="9.797" viewBox="0 0 21.992 9.797">
<path id="Path_448" data-name="Path 448" d="M20.286,207.506a1.764,1.764,0,0,0-1.764,1.764v4.5H3.586v-4.5a1.764,1.764,0,0,0-3.528,0v6.269A1.764,1.764,0,0,0,1.822,217.3H20.286a1.764,1.764,0,0,0,1.764-1.764V209.27A1.764,1.764,0,0,0,20.286,207.506Z" transform="translate(-0.058 -207.506)" fill="#fff"/>
</svg>
</span>
</span>

<p class="folder-wrapper__saved-element--folders-text">Add an external URL of image or upload an image from the device</p>
</figcaption>
</figure>
</div>
</div>
</div>

<div class="col-12 js-specification-sheet-box" style="display: none;">
<div class="folder-wrapper__specification-sheet--wrapper">

<div class="folder-wrapper__specification-sheet--buttons-box">

<div class="folder-wrapper__specification-sheet--buttons-box-content">
<span class="folder-wrapper__specification-sheet--buttons-box-image">
<svg xmlns="http://www.w3.org/2000/svg" width="24.704" height="16.27" viewBox="0 0 24.704 16.27">
<g id="open-folder-black-and-white-variant" transform="translate(0 -87.578)">
<path id="Path_434" data-name="Path 434" d="M18.618,102.844a1.7,1.7,0,0,0,1.429-.84l4.57-8.648c.273-.526-.124-.84-.84-.84H19.163V90.451a1.3,1.3,0,0,0-1.293-1.293H6.573l-.838-2.2a.59.59,0,0,0-.551-.38H.6a.589.589,0,0,0-.59.593l.011,3.28L0,101.554a1.3,1.3,0,0,0,1.293,1.293m16.69-10.33H7.922a1.392,1.392,0,0,0-1.134.84l-4.109,8.311H1.293a.114.114,0,0,1-.114-.114v-13.8h3.6l.838,2.2a.59.59,0,0,0,.551.38h11.7a.114.114,0,0,1,.114.114v2.066Z" transform="translate(0 1)" fill="#fff"/>
</g>
</svg>
</span>

<button class="folder-wrapper__specification-sheet--button js-hide-specification-sheet-box-btn">
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 495.785 495.785" xml:space="preserve"><path id="XMLID_26_" d="M436.855,90.337L255.175,0.541c-1.62-0.801-3.533-0.707-5.084,0.249c-1.535,0.957-2.467,2.638-2.467,4.449  v36.834H56.017v453.713h105.924V147.996h85.684v36.833c0,1.812,0.932,3.492,2.467,4.449c1.551,0.956,3.464,1.052,5.084,0.249  l181.68-89.796c1.791-0.888,2.914-2.706,2.914-4.698C439.769,93.043,438.646,91.225,436.855,90.337z"/><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
../ Specification sheet
</button>
</div>

<div class="d-flex justify-content-center align-items-center">
<div class="house-checkbox">
<input class="custom-checkbox js-load-confirm-modal" id="checkbox-14" type="checkbox" value="value14" data-target="#confirmModal">
<label for="checkbox-14">Share with Closets To Go</label>
</div>

<button class="folder-wrapper__specification-sheet--button second-button js-hide-specification-sheet-box-btn">
Back
</button>
</div>
</div>

<div class="mt-2 mb-2">
<p class="idea-folder-empty-house__heading">No saved files in 'Nice things for Guest Room folder!</p>
<p class="idea-folder-empty-house__text">You can add them from our website or by adding external images by choosing the option below</p>
</div>

</div>
</div>

<div class="col-12 js-add-to-rooms-new-idea-folder-images" style="display: none;">
<div class="new-idea-folder-images__wrapper">

<div class="new-idea-folder-images__buttons">

<div class="new-idea-folder-images__buttons-box-content">
<span class="new-idea-folder-images__buttons-box-image">
<svg xmlns="http://www.w3.org/2000/svg" width="24.704" height="16.27" viewBox="0 0 24.704 16.27">
<g id="open-folder-black-and-white-variant" transform="translate(0 -87.578)">
<path id="Path_434" data-name="Path 434" d="M18.618,102.844a1.7,1.7,0,0,0,1.429-.84l4.57-8.648c.273-.526-.124-.84-.84-.84H19.163V90.451a1.3,1.3,0,0,0-1.293-1.293H6.573l-.838-2.2a.59.59,0,0,0-.551-.38H.6a.589.589,0,0,0-.59.593l.011,3.28L0,101.554a1.3,1.3,0,0,0,1.293,1.293m16.69-10.33H7.922a1.392,1.392,0,0,0-1.134.84l-4.109,8.311H1.293a.114.114,0,0,1-.114-.114v-13.8h3.6l.838,2.2a.59.59,0,0,0,.551.38h11.7a.114.114,0,0,1,.114.114v2.066Z" transform="translate(0 1)" fill="#fff"></path>
</g>
</svg>
</span>

<button class="new-idea-folder-images__button first-button js-hide-add-to-rooms-new-idea-folder-images-btn">
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 495.785 495.785" xml:space="preserve"><path id="XMLID_26_" d="M436.855,90.337L255.175,0.541c-1.62-0.801-3.533-0.707-5.084,0.249c-1.535,0.957-2.467,2.638-2.467,4.449  v36.834H56.017v453.713h105.924V147.996h85.684v36.833c0,1.812,0.932,3.492,2.467,4.449c1.551,0.956,3.464,1.052,5.084,0.249  l181.68-89.796c1.791-0.888,2.914-2.706,2.914-4.698C439.769,93.043,438.646,91.225,436.855,90.337z"></path><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
../ Nice things for glob...
</button>
</div>

<button class="new-idea-folder-images__button back-btn js-hide-add-to-rooms-new-idea-folder-images-btn">
Back
</button>
</div>

<div class="mt-2 mb-2">
<p class="idea-folder-empty-house__heading">No saved files in 'Nice things for Guest Room folder!</p>
<p class="idea-folder-empty-house__text">You can add them from our website or by adding external images by choosing the option below</p>
</div>

<div class="folder-wrapper__saved-elements">
<figure class="folder-wrapper__saved-element add-new-button js-url-modal-btn" data-tab-parrent="#v-pills-playroom" data-button-positon="folder-name" data-toggle="modal" data-target="#newImageUrl">
<figcaption class="add-new-button__wrap">
<span class="svg-group">
<span class="svg-group__first">
<svg xmlns="http://www.w3.org/2000/svg" width="34.215" height="51.323" viewBox="0 0 34.215 51.323">
<path id="Path_451" data-name="Path 451" d="M161.684,17.839,146.714.731a2.134,2.134,0,0,0-3.216,0L128.529,17.839a2.137,2.137,0,0,0,1.608,3.546h8.554v27.8a2.139,2.139,0,0,0,2.138,2.138h8.554a2.139,2.139,0,0,0,2.138-2.138v-27.8h8.554a2.137,2.137,0,0,0,1.608-3.546Z" transform="translate(-127.998)" fill="#fff"/>
</svg>
</span>
<span class="svg-group__second">
<svg xmlns="http://www.w3.org/2000/svg" width="21.992" height="9.797" viewBox="0 0 21.992 9.797">
<path id="Path_448" data-name="Path 448" d="M20.286,207.506a1.764,1.764,0,0,0-1.764,1.764v4.5H3.586v-4.5a1.764,1.764,0,0,0-3.528,0v6.269A1.764,1.764,0,0,0,1.822,217.3H20.286a1.764,1.764,0,0,0,1.764-1.764V209.27A1.764,1.764,0,0,0,20.286,207.506Z" transform="translate(-0.058 -207.506)" fill="#fff"/>
</svg>
</span>
</span>

<p class="folder-wrapper__saved-element--folders-text">Add an external URL of image or upload an image from the device</p>
</figcaption>
</figure>
</div>
</div>
</div>
</div>
</div>
</div>


<div class="tab-pane fade" id="v-pills-library" role="tabpanel" aria-labelledby="v-pills-library-tab">
<div class="folder-wrapper">
<div class="desktop-show">
<div class="row mb-2">
<div class="col-8">
<h3 class="folder-wrapper__heading">Title house name 1 - Library</h3>
</div>
</div>
</div>
<div class="row">
<div class="col-12 js-saved-images-box">
<div class="new-idea-folder-images__wrapper">
<div class="new-idea-folder-images__buttons">

<p class="new-idea-folder-images__empty-text">
No saved files in Library!
</p>
</div>

<div class="mb-2">
<p class="idea-folder-empty-house__text">You can add them from our website or by adding external images by choosing the option below</p>
</div>

<div class="folder-wrapper__saved-elements">
<figure class="folder-wrapper__saved-element specification-sheet">
<figcaption class="folder-wrapper__saved-element--folders">
<span class="folder-wrapper__saved-element--folders-img">
<svg xmlns="http://www.w3.org/2000/svg" width="24.704" height="16.27" viewBox="0 0 24.704 16.27">
<g id="open-folder-black-and-white-variant" transform="translate(0 -87.578)">
<path id="Path_434" data-name="Path 434" d="M18.618,102.844a1.7,1.7,0,0,0,1.429-.84l4.57-8.648c.273-.526-.124-.84-.84-.84H19.163V90.451a1.3,1.3,0,0,0-1.293-1.293H6.573l-.838-2.2a.59.59,0,0,0-.551-.38H.6a.589.589,0,0,0-.59.593l.011,3.28L0,101.554a1.3,1.3,0,0,0,1.293,1.293m16.69-10.33H7.922a1.392,1.392,0,0,0-1.134.84l-4.109,8.311H1.293a.114.114,0,0,1-.114-.114v-13.8h3.6l.838,2.2a.59.59,0,0,0,.551.38h11.7a.114.114,0,0,1,.114.114v2.066Z" transform="translate(0 1)" fill="#fff"/>
</g>
</svg>
</span>
<div class="folder-wrapper__saved-element--buttons">
<button class="shere">
<svg xmlns="http://www.w3.org/2000/svg" width="23.547" height="25.688" viewBox="0 0 23.547 25.688"><defs><style>.share-white{fill:#fff;}</style></defs><g transform="translate(0)"><path class="share-white" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"/><path class="share-white" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"/><path class="share-white" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"/><path class="share-white" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"/><path class="share-white" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"/><path class="share-white" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"/><path class="share-white" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"/><path class="share-white" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"/></g></svg>
</button>
<button class="delete" data-toggle="modal" data-target="#deleteFolder">
<svg xmlns="http://www.w3.org/2000/svg" width="14.932" height="16.033" viewBox="0 0 14.932 16.033"><defs><style>.trash-white{fill:#fff;}</style></defs><g transform="translate(0 0)"><g transform="translate(0 0)"><g transform="translate(0 0)"><path class="trash-white" d="M63.331,124.769a1.305,1.305,0,0,0,1.351,1.168h5.771a1.328,1.328,0,0,0,1.374-1.191l.939-9.8H62.186Z" transform="translate(-60.01 -109.905)"/><path class="trash-white" d="M27.028,2.061h-4.26V1.328A1.283,1.283,0,0,0,21.533,0H18.577a1.282,1.282,0,0,0-1.306,1.259q0,.035,0,.07v.733h-4.26a.458.458,0,0,0,0,.916H27.028a.458.458,0,1,0,0-.916Zm-5.176-.733v.733H18.188V1.328a.366.366,0,0,1,.389-.412h2.886a.366.366,0,0,1,.391.34A.362.362,0,0,1,21.852,1.328Z" transform="translate(-12.554 0)"/></g></g></g></svg>
</button>
</div>
<p class="folder-wrapper__saved-element--text first">Specification sheet</p>
<button class="folder-wrapper__saved-element--folders-button"><span onClick="open_specs();">open folder</span></button>
</figcaption>
</figure>
<figure class="folder-wrapper__saved-element folders">
<figcaption class="folder-wrapper__saved-element--folders">
<span class="folder-wrapper__saved-element--folders-img">
<svg xmlns="http://www.w3.org/2000/svg" width="86" height="71.044" viewBox="0 0 86 71.044"><defs><style>.folder-orange{fill:#edb700;}</style></defs><g transform="translate(-10.667)"><g transform="translate(10.667 7.478)"><g transform="translate(0)"><path class="folder-orange" d="M87.319,53.884H44.1a5.6,5.6,0,0,1-5.321-3.836l-.329-.991a9.337,9.337,0,0,0-8.865-6.39H20.015a9.361,9.361,0,0,0-9.348,9.348v44.87a9.358,9.358,0,0,0,9.348,9.348H34.971a1.87,1.87,0,1,0,0-3.739H20.015a5.615,5.615,0,0,1-5.609-5.609V52.015a5.615,5.615,0,0,1,5.609-5.609h9.568A5.6,5.6,0,0,1,34.9,50.239l.333.995a9.337,9.337,0,0,0,8.865,6.39H87.319a5.615,5.615,0,0,1,5.609,5.609V96.884a5.615,5.615,0,0,1-5.609,5.609H72.363a1.87,1.87,0,0,0,0,3.739H87.319a9.356,9.356,0,0,0,9.348-9.348V63.232A9.358,9.358,0,0,0,87.319,53.884Z" transform="translate(-10.667 -42.667)"/></g></g><g transform="translate(14.406)"><path class="folder-orange" d="M101.174,0H41.348A9.361,9.361,0,0,0,32,9.348a1.87,1.87,0,0,0,3.739,0,5.615,5.615,0,0,1,5.609-5.609h59.826a5.615,5.615,0,0,1,5.609,5.609V20.565a1.87,1.87,0,1,0,3.739,0V9.348A9.359,9.359,0,0,0,101.174,0Z" transform="translate(-32)"/></g></g></svg>
</span>
<p class="folder-wrapper__saved-element--folders-text">Nice things for living room</p>
<button class="folder-wrapper__saved-element--folders-button js-show-add-to-rooms-new-idea-folder-images-btn">View folder</button>
</figcaption>
</figure>
<figure class="folder-wrapper__saved-element add-new-button js-url-modal-btn" data-tab-parrent="#v-pills-library" data-button-positon="room-name" data-toggle="modal" data-target="#newImageUrl">
<figcaption class="add-new-button__wrap">

<span class="svg-group">
<span class="svg-group__first">
<svg xmlns="http://www.w3.org/2000/svg" width="34.215" height="51.323" viewBox="0 0 34.215 51.323">
<path id="Path_451" data-name="Path 451" d="M161.684,17.839,146.714.731a2.134,2.134,0,0,0-3.216,0L128.529,17.839a2.137,2.137,0,0,0,1.608,3.546h8.554v27.8a2.139,2.139,0,0,0,2.138,2.138h8.554a2.139,2.139,0,0,0,2.138-2.138v-27.8h8.554a2.137,2.137,0,0,0,1.608-3.546Z" transform="translate(-127.998)" fill="#fff"/>
</svg>
</span>
<span class="svg-group__second">
<svg xmlns="http://www.w3.org/2000/svg" width="21.992" height="9.797" viewBox="0 0 21.992 9.797">
<path id="Path_448" data-name="Path 448" d="M20.286,207.506a1.764,1.764,0,0,0-1.764,1.764v4.5H3.586v-4.5a1.764,1.764,0,0,0-3.528,0v6.269A1.764,1.764,0,0,0,1.822,217.3H20.286a1.764,1.764,0,0,0,1.764-1.764V209.27A1.764,1.764,0,0,0,20.286,207.506Z" transform="translate(-0.058 -207.506)" fill="#fff"/>
</svg>
</span>
</span>

<p class="folder-wrapper__saved-element--folders-text">Add an external URL of image or upload an image from the device</p>
</figcaption>
</figure>
</div>
</div>
</div>

<div class="col-12 js-specification-sheet-box" style="display: none;">
<div class="folder-wrapper__specification-sheet--wrapper">

<div class="folder-wrapper__specification-sheet--buttons-box">

<div class="folder-wrapper__specification-sheet--buttons-box-content">
<span class="folder-wrapper__specification-sheet--buttons-box-image">
<svg xmlns="http://www.w3.org/2000/svg" width="24.704" height="16.27" viewBox="0 0 24.704 16.27">
<g id="open-folder-black-and-white-variant" transform="translate(0 -87.578)">
<path id="Path_434" data-name="Path 434" d="M18.618,102.844a1.7,1.7,0,0,0,1.429-.84l4.57-8.648c.273-.526-.124-.84-.84-.84H19.163V90.451a1.3,1.3,0,0,0-1.293-1.293H6.573l-.838-2.2a.59.59,0,0,0-.551-.38H.6a.589.589,0,0,0-.59.593l.011,3.28L0,101.554a1.3,1.3,0,0,0,1.293,1.293m16.69-10.33H7.922a1.392,1.392,0,0,0-1.134.84l-4.109,8.311H1.293a.114.114,0,0,1-.114-.114v-13.8h3.6l.838,2.2a.59.59,0,0,0,.551.38h11.7a.114.114,0,0,1,.114.114v2.066Z" transform="translate(0 1)" fill="#fff"/>
</g>
</svg>
</span>

<button class="folder-wrapper__specification-sheet--button js-hide-specification-sheet-box-btn">
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 495.785 495.785" xml:space="preserve"><path id="XMLID_26_" d="M436.855,90.337L255.175,0.541c-1.62-0.801-3.533-0.707-5.084,0.249c-1.535,0.957-2.467,2.638-2.467,4.449  v36.834H56.017v453.713h105.924V147.996h85.684v36.833c0,1.812,0.932,3.492,2.467,4.449c1.551,0.956,3.464,1.052,5.084,0.249  l181.68-89.796c1.791-0.888,2.914-2.706,2.914-4.698C439.769,93.043,438.646,91.225,436.855,90.337z"/><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
../ Specification sheet
</button>
</div>

<div class="d-flex justify-content-center align-items-center">
<div class="house-checkbox">
<input class="custom-checkbox js-load-confirm-modal" id="checkbox-15" type="checkbox" value="value15" data-target="#confirmModal">
<label for="checkbox-15">Share with Closets To Go</label>
</div>

<button class="folder-wrapper__specification-sheet--button second-button js-hide-specification-sheet-box-btn">
Back
</button>
</div>
</div>

<div class="mt-2 mb-2">
<p class="idea-folder-empty-house__heading">No saved files in 'Nice things for Guest Room folder!</p>
<p class="idea-folder-empty-house__text">You can add them from our website or by adding external images by choosing the option below</p>
</div>

</div>
</div>

<div class="col-12 js-add-to-rooms-new-idea-folder-images" style="display: none;">
<div class="new-idea-folder-images__wrapper">

<div class="new-idea-folder-images__buttons">

<div class="new-idea-folder-images__buttons-box-content">
<span class="new-idea-folder-images__buttons-box-image">
<svg xmlns="http://www.w3.org/2000/svg" width="24.704" height="16.27" viewBox="0 0 24.704 16.27">
<g id="open-folder-black-and-white-variant" transform="translate(0 -87.578)">
<path id="Path_434" data-name="Path 434" d="M18.618,102.844a1.7,1.7,0,0,0,1.429-.84l4.57-8.648c.273-.526-.124-.84-.84-.84H19.163V90.451a1.3,1.3,0,0,0-1.293-1.293H6.573l-.838-2.2a.59.59,0,0,0-.551-.38H.6a.589.589,0,0,0-.59.593l.011,3.28L0,101.554a1.3,1.3,0,0,0,1.293,1.293m16.69-10.33H7.922a1.392,1.392,0,0,0-1.134.84l-4.109,8.311H1.293a.114.114,0,0,1-.114-.114v-13.8h3.6l.838,2.2a.59.59,0,0,0,.551.38h11.7a.114.114,0,0,1,.114.114v2.066Z" transform="translate(0 1)" fill="#fff"></path>
</g>
</svg>
</span>

<button class="new-idea-folder-images__button first-button js-hide-add-to-rooms-new-idea-folder-images-btn">
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 495.785 495.785" xml:space="preserve"><path id="XMLID_26_" d="M436.855,90.337L255.175,0.541c-1.62-0.801-3.533-0.707-5.084,0.249c-1.535,0.957-2.467,2.638-2.467,4.449  v36.834H56.017v453.713h105.924V147.996h85.684v36.833c0,1.812,0.932,3.492,2.467,4.449c1.551,0.956,3.464,1.052,5.084,0.249  l181.68-89.796c1.791-0.888,2.914-2.706,2.914-4.698C439.769,93.043,438.646,91.225,436.855,90.337z"></path><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
../ Nice things for glob...
</button>
</div>

<button class="new-idea-folder-images__button back-btn js-hide-add-to-rooms-new-idea-folder-images-btn">
Back
</button>
</div>

<div class="mt-2 mb-2">
<p class="idea-folder-empty-house__heading">No saved files in 'Nice things for Guest Room folder!</p>
<p class="idea-folder-empty-house__text">You can add them from our website or by adding external images by choosing the option below</p>
</div>

<div class="folder-wrapper__saved-elements">
<figure class="folder-wrapper__saved-element add-new-button js-url-modal-btn" data-tab-parrent="#v-pills-library" data-button-positon="folder-name" data-toggle="modal" data-target="#newImageUrl">
<figcaption class="add-new-button__wrap">
<span class="svg-group">
<span class="svg-group__first">
<svg xmlns="http://www.w3.org/2000/svg" width="34.215" height="51.323" viewBox="0 0 34.215 51.323">
<path id="Path_451" data-name="Path 451" d="M161.684,17.839,146.714.731a2.134,2.134,0,0,0-3.216,0L128.529,17.839a2.137,2.137,0,0,0,1.608,3.546h8.554v27.8a2.139,2.139,0,0,0,2.138,2.138h8.554a2.139,2.139,0,0,0,2.138-2.138v-27.8h8.554a2.137,2.137,0,0,0,1.608-3.546Z" transform="translate(-127.998)" fill="#fff"/>
</svg>
</span>
<span class="svg-group__second">
<svg xmlns="http://www.w3.org/2000/svg" width="21.992" height="9.797" viewBox="0 0 21.992 9.797">
<path id="Path_448" data-name="Path 448" d="M20.286,207.506a1.764,1.764,0,0,0-1.764,1.764v4.5H3.586v-4.5a1.764,1.764,0,0,0-3.528,0v6.269A1.764,1.764,0,0,0,1.822,217.3H20.286a1.764,1.764,0,0,0,1.764-1.764V209.27A1.764,1.764,0,0,0,20.286,207.506Z" transform="translate(-0.058 -207.506)" fill="#fff"/>
</svg>
</span>
</span>

<p class="folder-wrapper__saved-element--folders-text">Add an external URL of image or upload an image from the device</p>
</figcaption>
</figure>
</div>
</div>
</div>
</div>
</div>
</div>


<div class="tab-pane fade" id="v-pills-storage-room" role="tabpanel" aria-labelledby="v-pills-storage-room-tab">
<div class="folder-wrapper">
<div class="desktop-show">
<div class="row mb-2">
<div class="col-8">
<h3 class="folder-wrapper__heading">Title house name 1 - Storage room</h3>
</div>
</div>
</div>
<div class="row">
<div class="col-12 js-saved-images-box">
<div class="new-idea-folder-images__wrapper">
<div class="new-idea-folder-images__buttons">

<p class="new-idea-folder-images__empty-text">
No saved files in Storage room!
</p>
</div>

<div class="mb-2">
<p class="idea-folder-empty-house__text">You can add them from our website or by adding external images by choosing the option below</p>
</div>

<div class="folder-wrapper__saved-elements">
<figure class="folder-wrapper__saved-element specification-sheet">
<figcaption class="folder-wrapper__saved-element--folders">
<span class="folder-wrapper__saved-element--folders-img">
<svg xmlns="http://www.w3.org/2000/svg" width="24.704" height="16.27" viewBox="0 0 24.704 16.27">
<g id="open-folder-black-and-white-variant" transform="translate(0 -87.578)">
<path id="Path_434" data-name="Path 434" d="M18.618,102.844a1.7,1.7,0,0,0,1.429-.84l4.57-8.648c.273-.526-.124-.84-.84-.84H19.163V90.451a1.3,1.3,0,0,0-1.293-1.293H6.573l-.838-2.2a.59.59,0,0,0-.551-.38H.6a.589.589,0,0,0-.59.593l.011,3.28L0,101.554a1.3,1.3,0,0,0,1.293,1.293m16.69-10.33H7.922a1.392,1.392,0,0,0-1.134.84l-4.109,8.311H1.293a.114.114,0,0,1-.114-.114v-13.8h3.6l.838,2.2a.59.59,0,0,0,.551.38h11.7a.114.114,0,0,1,.114.114v2.066Z" transform="translate(0 1)" fill="#fff"/>
</g>
</svg>
</span>
<div class="folder-wrapper__saved-element--buttons">
<button class="shere">
<svg xmlns="http://www.w3.org/2000/svg" width="23.547" height="25.688" viewBox="0 0 23.547 25.688"><defs><style>.share-white{fill:#fff;}</style></defs><g transform="translate(0)"><path class="share-white" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"/><path class="share-white" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"/><path class="share-white" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"/><path class="share-white" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"/><path class="share-white" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"/><path class="share-white" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"/><path class="share-white" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"/><path class="share-white" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"/></g></svg>
</button>
<button class="delete" data-toggle="modal" data-target="#deleteFolder">
<svg xmlns="http://www.w3.org/2000/svg" width="14.932" height="16.033" viewBox="0 0 14.932 16.033"><defs><style>.trash-white{fill:#fff;}</style></defs><g transform="translate(0 0)"><g transform="translate(0 0)"><g transform="translate(0 0)"><path class="trash-white" d="M63.331,124.769a1.305,1.305,0,0,0,1.351,1.168h5.771a1.328,1.328,0,0,0,1.374-1.191l.939-9.8H62.186Z" transform="translate(-60.01 -109.905)"/><path class="trash-white" d="M27.028,2.061h-4.26V1.328A1.283,1.283,0,0,0,21.533,0H18.577a1.282,1.282,0,0,0-1.306,1.259q0,.035,0,.07v.733h-4.26a.458.458,0,0,0,0,.916H27.028a.458.458,0,1,0,0-.916Zm-5.176-.733v.733H18.188V1.328a.366.366,0,0,1,.389-.412h2.886a.366.366,0,0,1,.391.34A.362.362,0,0,1,21.852,1.328Z" transform="translate(-12.554 0)"/></g></g></g></svg>
</button>
</div>
<p class="folder-wrapper__saved-element--text first">Specification sheet</p>
<button class="folder-wrapper__saved-element--folders-button"><span onClick="open_specs();">open folder</span></button>
</figcaption>
</figure>
<figure class="folder-wrapper__saved-element folders">
<figcaption class="folder-wrapper__saved-element--folders">
<span class="folder-wrapper__saved-element--folders-img">
<svg xmlns="http://www.w3.org/2000/svg" width="86" height="71.044" viewBox="0 0 86 71.044"><defs><style>.folder-orange{fill:#edb700;}</style></defs><g transform="translate(-10.667)"><g transform="translate(10.667 7.478)"><g transform="translate(0)"><path class="folder-orange" d="M87.319,53.884H44.1a5.6,5.6,0,0,1-5.321-3.836l-.329-.991a9.337,9.337,0,0,0-8.865-6.39H20.015a9.361,9.361,0,0,0-9.348,9.348v44.87a9.358,9.358,0,0,0,9.348,9.348H34.971a1.87,1.87,0,1,0,0-3.739H20.015a5.615,5.615,0,0,1-5.609-5.609V52.015a5.615,5.615,0,0,1,5.609-5.609h9.568A5.6,5.6,0,0,1,34.9,50.239l.333.995a9.337,9.337,0,0,0,8.865,6.39H87.319a5.615,5.615,0,0,1,5.609,5.609V96.884a5.615,5.615,0,0,1-5.609,5.609H72.363a1.87,1.87,0,0,0,0,3.739H87.319a9.356,9.356,0,0,0,9.348-9.348V63.232A9.358,9.358,0,0,0,87.319,53.884Z" transform="translate(-10.667 -42.667)"/></g></g><g transform="translate(14.406)"><path class="folder-orange" d="M101.174,0H41.348A9.361,9.361,0,0,0,32,9.348a1.87,1.87,0,0,0,3.739,0,5.615,5.615,0,0,1,5.609-5.609h59.826a5.615,5.615,0,0,1,5.609,5.609V20.565a1.87,1.87,0,1,0,3.739,0V9.348A9.359,9.359,0,0,0,101.174,0Z" transform="translate(-32)"/></g></g></svg>
</span>
<p class="folder-wrapper__saved-element--folders-text">Nice things for living room</p>
<button class="folder-wrapper__saved-element--folders-button js-show-add-to-rooms-new-idea-folder-images-btn">View folder</button>
</figcaption>
</figure>
<figure class="folder-wrapper__saved-element add-new-button js-url-modal-btn" data-tab-parrent="#v-pills-storage-room" data-button-positon="room-name" data-toggle="modal" data-target="#newImageUrl">
<figcaption class="add-new-button__wrap">

<span class="svg-group">
<span class="svg-group__first">
<svg xmlns="http://www.w3.org/2000/svg" width="34.215" height="51.323" viewBox="0 0 34.215 51.323">
<path id="Path_451" data-name="Path 451" d="M161.684,17.839,146.714.731a2.134,2.134,0,0,0-3.216,0L128.529,17.839a2.137,2.137,0,0,0,1.608,3.546h8.554v27.8a2.139,2.139,0,0,0,2.138,2.138h8.554a2.139,2.139,0,0,0,2.138-2.138v-27.8h8.554a2.137,2.137,0,0,0,1.608-3.546Z" transform="translate(-127.998)" fill="#fff"/>
</svg>
</span>
<span class="svg-group__second">
<svg xmlns="http://www.w3.org/2000/svg" width="21.992" height="9.797" viewBox="0 0 21.992 9.797">
<path id="Path_448" data-name="Path 448" d="M20.286,207.506a1.764,1.764,0,0,0-1.764,1.764v4.5H3.586v-4.5a1.764,1.764,0,0,0-3.528,0v6.269A1.764,1.764,0,0,0,1.822,217.3H20.286a1.764,1.764,0,0,0,1.764-1.764V209.27A1.764,1.764,0,0,0,20.286,207.506Z" transform="translate(-0.058 -207.506)" fill="#fff"/>
</svg>
</span>
</span>

<p class="folder-wrapper__saved-element--folders-text">Add an external URL of image or upload an image from the device</p>
</figcaption>
</figure>
</div>
</div>
</div>


<div class="col-12 js-specification-sheet-box" style="display: none;">
<div class="folder-wrapper__specification-sheet--wrapper">
<div class="folder-wrapper__specification-sheet--buttons-box">
<div class="folder-wrapper__specification-sheet--buttons-box-content">
<span class="folder-wrapper__specification-sheet--buttons-box-image">
<svg xmlns="http://www.w3.org/2000/svg" width="24.704" height="16.27" viewBox="0 0 24.704 16.27">
<g id="open-folder-black-and-white-variant" transform="translate(0 -87.578)">
<path id="Path_434" data-name="Path 434" d="M18.618,102.844a1.7,1.7,0,0,0,1.429-.84l4.57-8.648c.273-.526-.124-.84-.84-.84H19.163V90.451a1.3,1.3,0,0,0-1.293-1.293H6.573l-.838-2.2a.59.59,0,0,0-.551-.38H.6a.589.589,0,0,0-.59.593l.011,3.28L0,101.554a1.3,1.3,0,0,0,1.293,1.293m16.69-10.33H7.922a1.392,1.392,0,0,0-1.134.84l-4.109,8.311H1.293a.114.114,0,0,1-.114-.114v-13.8h3.6l.838,2.2a.59.59,0,0,0,.551.38h11.7a.114.114,0,0,1,.114.114v2.066Z" transform="translate(0 1)" fill="#fff"/>
</g>
</svg>
</span>

<button class="folder-wrapper__specification-sheet--button js-hide-specification-sheet-box-btn">
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 495.785 495.785" xml:space="preserve"><path id="XMLID_26_" d="M436.855,90.337L255.175,0.541c-1.62-0.801-3.533-0.707-5.084,0.249c-1.535,0.957-2.467,2.638-2.467,4.449  v36.834H56.017v453.713h105.924V147.996h85.684v36.833c0,1.812,0.932,3.492,2.467,4.449c1.551,0.956,3.464,1.052,5.084,0.249  l181.68-89.796c1.791-0.888,2.914-2.706,2.914-4.698C439.769,93.043,438.646,91.225,436.855,90.337z"/><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
../ Specification sheet
</button>
</div>

<div class="d-flex justify-content-center align-items-center">
<div class="house-checkbox">
<input class="custom-checkbox js-load-confirm-modal" id="checkbox-16" type="checkbox" value="value16" data-target="#confirmModal">
<label for="checkbox-16">Share with Closets To Go</label>
</div>

<button class="folder-wrapper__specification-sheet--button second-button js-hide-specification-sheet-box-btn">
Back
</button>
</div>
</div>

<div class="mt-2 mb-2">
<p class="idea-folder-empty-house__heading">No saved files in 'Nice things for Guest Room folder!</p>
<p class="idea-folder-empty-house__text">You can add them from our website or by adding external images by choosing the option below</p>
</div>

</div>
</div>

<div class="col-12 js-add-to-rooms-new-idea-folder-images" style="display: none;">
<div class="new-idea-folder-images__wrapper">

<div class="new-idea-folder-images__buttons">

<div class="new-idea-folder-images__buttons-box-content">
<span class="new-idea-folder-images__buttons-box-image">
<svg xmlns="http://www.w3.org/2000/svg" width="24.704" height="16.27" viewBox="0 0 24.704 16.27">
<g id="open-folder-black-and-white-variant" transform="translate(0 -87.578)">
<path id="Path_434" data-name="Path 434" d="M18.618,102.844a1.7,1.7,0,0,0,1.429-.84l4.57-8.648c.273-.526-.124-.84-.84-.84H19.163V90.451a1.3,1.3,0,0,0-1.293-1.293H6.573l-.838-2.2a.59.59,0,0,0-.551-.38H.6a.589.589,0,0,0-.59.593l.011,3.28L0,101.554a1.3,1.3,0,0,0,1.293,1.293m16.69-10.33H7.922a1.392,1.392,0,0,0-1.134.84l-4.109,8.311H1.293a.114.114,0,0,1-.114-.114v-13.8h3.6l.838,2.2a.59.59,0,0,0,.551.38h11.7a.114.114,0,0,1,.114.114v2.066Z" transform="translate(0 1)" fill="#fff"></path>
</g>
</svg>
</span>

<button class="new-idea-folder-images__button first-button js-hide-add-to-rooms-new-idea-folder-images-btn">
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 495.785 495.785" xml:space="preserve"><path id="XMLID_26_" d="M436.855,90.337L255.175,0.541c-1.62-0.801-3.533-0.707-5.084,0.249c-1.535,0.957-2.467,2.638-2.467,4.449  v36.834H56.017v453.713h105.924V147.996h85.684v36.833c0,1.812,0.932,3.492,2.467,4.449c1.551,0.956,3.464,1.052,5.084,0.249  l181.68-89.796c1.791-0.888,2.914-2.706,2.914-4.698C439.769,93.043,438.646,91.225,436.855,90.337z"></path><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
../ Nice things for glob...
</button>
</div>

<button class="new-idea-folder-images__button back-btn js-hide-add-to-rooms-new-idea-folder-images-btn">
Back
</button>
</div>

<div class="mt-2 mb-2">
<p class="idea-folder-empty-house__heading">No saved files in 'Nice things for Guest Room folder!</p>
<p class="idea-folder-empty-house__text">You can add them from our website or by adding external images by choosing the option below</p>
</div>

<div class="folder-wrapper__saved-elements">
<figure class="folder-wrapper__saved-element add-new-button js-url-modal-btn" data-tab-parrent="#v-pills-storage-room" data-button-positon="folder-name" data-toggle="modal" data-target="#newImageUrl">
<figcaption class="add-new-button__wrap">
<span class="svg-group">
<span class="svg-group__first">
<svg xmlns="http://www.w3.org/2000/svg" width="34.215" height="51.323" viewBox="0 0 34.215 51.323">
<path id="Path_451" data-name="Path 451" d="M161.684,17.839,146.714.731a2.134,2.134,0,0,0-3.216,0L128.529,17.839a2.137,2.137,0,0,0,1.608,3.546h8.554v27.8a2.139,2.139,0,0,0,2.138,2.138h8.554a2.139,2.139,0,0,0,2.138-2.138v-27.8h8.554a2.137,2.137,0,0,0,1.608-3.546Z" transform="translate(-127.998)" fill="#fff"/>
</svg>
</span>
<span class="svg-group__second">
<svg xmlns="http://www.w3.org/2000/svg" width="21.992" height="9.797" viewBox="0 0 21.992 9.797">
<path id="Path_448" data-name="Path 448" d="M20.286,207.506a1.764,1.764,0,0,0-1.764,1.764v4.5H3.586v-4.5a1.764,1.764,0,0,0-3.528,0v6.269A1.764,1.764,0,0,0,1.822,217.3H20.286a1.764,1.764,0,0,0,1.764-1.764V209.27A1.764,1.764,0,0,0,20.286,207.506Z" transform="translate(-0.058 -207.506)" fill="#fff"/>
</svg>
</span>
</span>

<p class="folder-wrapper__saved-element--folders-text">Add an external URL of image or upload an image from the device</p>
</figcaption>
</figure>
</div>
</div>
</div>
</div>
</div>
</div>



<div class="tab-pane fade" id="v-pills-gym-room" role="tabpanel" aria-labelledby="v-pills-gym-room-tab">
<div class="folder-wrapper">
<div class="desktop-show">
<div class="row mb-2">
<div class="col-8">
<h3 class="folder-wrapper__heading">Title house name 1 - Gym room</h3>
</div>
</div>
</div>
<div class="row">		
<div class="col-12 js-saved-images-box">
<div class="new-idea-folder-images__wrapper">
<div class="new-idea-folder-images__buttons">
<p class="new-idea-folder-images__empty-text">
No saved files in Gym room!
</p>
</div>
<div class="mb-2">
<p class="idea-folder-empty-house__text">You can add them from our website or by adding external images by choosing the option below</p>
</div>
<div class="folder-wrapper__saved-elements">
<figure class="folder-wrapper__saved-element specification-sheet">
<figcaption class="folder-wrapper__saved-element--folders">
<span class="folder-wrapper__saved-element--folders-img">
<svg xmlns="http://www.w3.org/2000/svg" width="24.704" height="16.27" viewBox="0 0 24.704 16.27">
<g id="open-folder-black-and-white-variant" transform="translate(0 -87.578)">
<path id="Path_434" data-name="Path 434" d="M18.618,102.844a1.7,1.7,0,0,0,1.429-.84l4.57-8.648c.273-.526-.124-.84-.84-.84H19.163V90.451a1.3,1.3,0,0,0-1.293-1.293H6.573l-.838-2.2a.59.59,0,0,0-.551-.38H.6a.589.589,0,0,0-.59.593l.011,3.28L0,101.554a1.3,1.3,0,0,0,1.293,1.293m16.69-10.33H7.922a1.392,1.392,0,0,0-1.134.84l-4.109,8.311H1.293a.114.114,0,0,1-.114-.114v-13.8h3.6l.838,2.2a.59.59,0,0,0,.551.38h11.7a.114.114,0,0,1,.114.114v2.066Z" transform="translate(0 1)" fill="#fff"/>
</g>
</svg>
</span>
<div class="folder-wrapper__saved-element--buttons">
<button class="shere">
<svg xmlns="http://www.w3.org/2000/svg" width="23.547" height="25.688" viewBox="0 0 23.547 25.688"><defs><style>.share-white{fill:#fff;}</style></defs><g transform="translate(0)"><path class="share-white" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"/><path class="share-white" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"/><path class="share-white" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"/><path class="share-white" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"/><path class="share-white" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"/><path class="share-white" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"/><path class="share-white" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"/><path class="share-white" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"/></g></svg>
</button>
<button class="delete" data-toggle="modal" data-target="#deleteFolder">
<svg xmlns="http://www.w3.org/2000/svg" width="14.932" height="16.033" viewBox="0 0 14.932 16.033"><defs><style>.trash-white{fill:#fff;}</style></defs><g transform="translate(0 0)"><g transform="translate(0 0)"><g transform="translate(0 0)"><path class="trash-white" d="M63.331,124.769a1.305,1.305,0,0,0,1.351,1.168h5.771a1.328,1.328,0,0,0,1.374-1.191l.939-9.8H62.186Z" transform="translate(-60.01 -109.905)"/><path class="trash-white" d="M27.028,2.061h-4.26V1.328A1.283,1.283,0,0,0,21.533,0H18.577a1.282,1.282,0,0,0-1.306,1.259q0,.035,0,.07v.733h-4.26a.458.458,0,0,0,0,.916H27.028a.458.458,0,1,0,0-.916Zm-5.176-.733v.733H18.188V1.328a.366.366,0,0,1,.389-.412h2.886a.366.366,0,0,1,.391.34A.362.362,0,0,1,21.852,1.328Z" transform="translate(-12.554 0)"/></g></g></g></svg>
</button>
</div>
<p class="folder-wrapper__saved-element--text first">Specification sheet</p>
<button class="folder-wrapper__saved-element--folders-button"><span onClick="open_specs();">open folder</span></button>
</figcaption>
</figure>

<!-- Nice things for -->
<figure class="folder-wrapper__saved-element folders">
<figcaption class="folder-wrapper__saved-element--folders">
<span class="folder-wrapper__saved-element--folders-img">
<svg xmlns="http://www.w3.org/2000/svg" width="86" height="71.044" viewBox="0 0 86 71.044"><defs><style>.folder-orange{fill:#edb700;}</style></defs><g transform="translate(-10.667)"><g transform="translate(10.667 7.478)"><g transform="translate(0)"><path class="folder-orange" d="M87.319,53.884H44.1a5.6,5.6,0,0,1-5.321-3.836l-.329-.991a9.337,9.337,0,0,0-8.865-6.39H20.015a9.361,9.361,0,0,0-9.348,9.348v44.87a9.358,9.358,0,0,0,9.348,9.348H34.971a1.87,1.87,0,1,0,0-3.739H20.015a5.615,5.615,0,0,1-5.609-5.609V52.015a5.615,5.615,0,0,1,5.609-5.609h9.568A5.6,5.6,0,0,1,34.9,50.239l.333.995a9.337,9.337,0,0,0,8.865,6.39H87.319a5.615,5.615,0,0,1,5.609,5.609V96.884a5.615,5.615,0,0,1-5.609,5.609H72.363a1.87,1.87,0,0,0,0,3.739H87.319a9.356,9.356,0,0,0,9.348-9.348V63.232A9.358,9.358,0,0,0,87.319,53.884Z" transform="translate(-10.667 -42.667)"/></g></g><g transform="translate(14.406)"><path class="folder-orange" d="M101.174,0H41.348A9.361,9.361,0,0,0,32,9.348a1.87,1.87,0,0,0,3.739,0,5.615,5.615,0,0,1,5.609-5.609h59.826a5.615,5.615,0,0,1,5.609,5.609V20.565a1.87,1.87,0,1,0,3.739,0V9.348A9.359,9.359,0,0,0,101.174,0Z" transform="translate(-32)"/></g></g></svg>
</span>
<p class="folder-wrapper__saved-element--folders-text">Nice things for living room</p>
<button class="folder-wrapper__saved-element--folders-button js-show-add-to-rooms-new-idea-folder-images-btn">View folder</button>
</figcaption>
</figure>
<!-- Add Image URL or Upload -->
<figure class="folder-wrapper__saved-element add-new-button js-url-modal-btn" data-tab-parrent="#v-pills-gym-room" data-button-positon="room-name" data-toggle="modal" data-target="#newImageUrl">
<figcaption class="add-new-button__wrap">
<span class="svg-group">
<span class="svg-group__first">
<svg xmlns="http://www.w3.org/2000/svg" width="34.215" height="51.323" viewBox="0 0 34.215 51.323">
<path id="Path_451" data-name="Path 451" d="M161.684,17.839,146.714.731a2.134,2.134,0,0,0-3.216,0L128.529,17.839a2.137,2.137,0,0,0,1.608,3.546h8.554v27.8a2.139,2.139,0,0,0,2.138,2.138h8.554a2.139,2.139,0,0,0,2.138-2.138v-27.8h8.554a2.137,2.137,0,0,0,1.608-3.546Z" transform="translate(-127.998)" fill="#fff"/>
</svg>
</span>
<span class="svg-group__second">
<svg xmlns="http://www.w3.org/2000/svg" width="21.992" height="9.797" viewBox="0 0 21.992 9.797">
<path id="Path_448" data-name="Path 448" d="M20.286,207.506a1.764,1.764,0,0,0-1.764,1.764v4.5H3.586v-4.5a1.764,1.764,0,0,0-3.528,0v6.269A1.764,1.764,0,0,0,1.822,217.3H20.286a1.764,1.764,0,0,0,1.764-1.764V209.27A1.764,1.764,0,0,0,20.286,207.506Z" transform="translate(-0.058 -207.506)" fill="#fff"/>
</svg>
</span>
</span>	
<p class="folder-wrapper__saved-element--folders-text">Add an external URL of image or upload an image from the device</p>
</figcaption>
</figure>
</div>
</div>
</div>

<!-- Specification sheet -->					
<div class="col-12 js-specification-sheet-box" style="display: none;">
<div class="folder-wrapper__specification-sheet--wrapper">
<div class="folder-wrapper__specification-sheet--buttons-box">
<div class="folder-wrapper__specification-sheet--buttons-box-content">
<span class="folder-wrapper__specification-sheet--buttons-box-image">
<svg xmlns="http://www.w3.org/2000/svg" width="24.704" height="16.27" viewBox="0 0 24.704 16.27">
<g id="open-folder-black-and-white-variant" transform="translate(0 -87.578)">
<path id="Path_434" data-name="Path 434" d="M18.618,102.844a1.7,1.7,0,0,0,1.429-.84l4.57-8.648c.273-.526-.124-.84-.84-.84H19.163V90.451a1.3,1.3,0,0,0-1.293-1.293H6.573l-.838-2.2a.59.59,0,0,0-.551-.38H.6a.589.589,0,0,0-.59.593l.011,3.28L0,101.554a1.3,1.3,0,0,0,1.293,1.293m16.69-10.33H7.922a1.392,1.392,0,0,0-1.134.84l-4.109,8.311H1.293a.114.114,0,0,1-.114-.114v-13.8h3.6l.838,2.2a.59.59,0,0,0,.551.38h11.7a.114.114,0,0,1,.114.114v2.066Z" transform="translate(0 1)" fill="#fff"/>
</g>
</svg>
</span>
<button class="folder-wrapper__specification-sheet--button js-hide-specification-sheet-box-btn">
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 495.785 495.785" xml:space="preserve"><path id="XMLID_26_" d="M436.855,90.337L255.175,0.541c-1.62-0.801-3.533-0.707-5.084,0.249c-1.535,0.957-2.467,2.638-2.467,4.449  v36.834H56.017v453.713h105.924V147.996h85.684v36.833c0,1.812,0.932,3.492,2.467,4.449c1.551,0.956,3.464,1.052,5.084,0.249  l181.68-89.796c1.791-0.888,2.914-2.706,2.914-4.698C439.769,93.043,438.646,91.225,436.855,90.337z"/><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
Specification sheet
</button>
</div>
<div class="d-flex justify-content-center align-items-center">
<div class="house-checkbox">
<input class="custom-checkbox js-load-confirm-modal" id="checkbox-17" type="checkbox" value="value17" data-target="#confirmModal">
<label for="checkbox-17">Share with Closets To Go</label>
</div>
<button class="folder-wrapper__specification-sheet--button second-button js-hide-specification-sheet-box-btn">
Back
</button>
</div>
</div>
<div class="mt-2 mb-2">
<p class="idea-folder-empty-house__heading">No saved files in 'Nice things for Guest Room folder!</p>
<p class="idea-folder-empty-house__text">You can add them from our website or by adding external images by choosing the option below</p>
</div>
</div>
</div>

<div class="col-12 js-add-to-rooms-new-idea-folder-images" style="display: none;">
<div class="new-idea-folder-images__wrapper">

<!-- Nice things for -->
<div class="new-idea-folder-images__buttons">
<div class="new-idea-folder-images__buttons-box-content">
<span class="new-idea-folder-images__buttons-box-image">
<svg xmlns="http://www.w3.org/2000/svg" width="24.704" height="16.27" viewBox="0 0 24.704 16.27">
<g id="open-folder-black-and-white-variant" transform="translate(0 -87.578)">
<path id="Path_434" data-name="Path 434" d="M18.618,102.844a1.7,1.7,0,0,0,1.429-.84l4.57-8.648c.273-.526-.124-.84-.84-.84H19.163V90.451a1.3,1.3,0,0,0-1.293-1.293H6.573l-.838-2.2a.59.59,0,0,0-.551-.38H.6a.589.589,0,0,0-.59.593l.011,3.28L0,101.554a1.3,1.3,0,0,0,1.293,1.293m16.69-10.33H7.922a1.392,1.392,0,0,0-1.134.84l-4.109,8.311H1.293a.114.114,0,0,1-.114-.114v-13.8h3.6l.838,2.2a.59.59,0,0,0,.551.38h11.7a.114.114,0,0,1,.114.114v2.066Z" transform="translate(0 1)" fill="#fff"></path>
</g>
</svg>
</span>
<button class="new-idea-folder-images__button first-button js-hide-add-to-rooms-new-idea-folder-images-btn">
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 495.785 495.785" xml:space="preserve"><path id="XMLID_26_" d="M436.855,90.337L255.175,0.541c-1.62-0.801-3.533-0.707-5.084,0.249c-1.535,0.957-2.467,2.638-2.467,4.449  v36.834H56.017v453.713h105.924V147.996h85.684v36.833c0,1.812,0.932,3.492,2.467,4.449c1.551,0.956,3.464,1.052,5.084,0.249  l181.68-89.796c1.791-0.888,2.914-2.706,2.914-4.698C439.769,93.043,438.646,91.225,436.855,90.337z"></path><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
Nice things for glob...
</button>
</div>
<button class="new-idea-folder-images__button back-btn js-hide-add-to-rooms-new-idea-folder-images-btn">
Back
</button>
</div>
<div class="mt-2 mb-2">
<p class="idea-folder-empty-house__heading">No saved files in 'Nice things for Guest Room folder!</p>
<p class="idea-folder-empty-house__text">You can add them from our website or by adding external images by choosing the option below</p>
</div>
<div class="folder-wrapper__saved-elements">
<figure class="folder-wrapper__saved-element add-new-button js-url-modal-btn" data-tab-parrent="#v-pills-gym-room" data-button-positon="folder-name" data-toggle="modal" data-target="#newImageUrl">
<figcaption class="add-new-button__wrap">
<span class="svg-group">
<span class="svg-group__first">
<svg xmlns="http://www.w3.org/2000/svg" width="34.215" height="51.323" viewBox="0 0 34.215 51.323">
<path id="Path_451" data-name="Path 451" d="M161.684,17.839,146.714.731a2.134,2.134,0,0,0-3.216,0L128.529,17.839a2.137,2.137,0,0,0,1.608,3.546h8.554v27.8a2.139,2.139,0,0,0,2.138,2.138h8.554a2.139,2.139,0,0,0,2.138-2.138v-27.8h8.554a2.137,2.137,0,0,0,1.608-3.546Z" transform="translate(-127.998)" fill="#fff"/>
</svg>
</span>
<span class="svg-group__second">
<svg xmlns="http://www.w3.org/2000/svg" width="21.992" height="9.797" viewBox="0 0 21.992 9.797">
<path id="Path_448" data-name="Path 448" d="M20.286,207.506a1.764,1.764,0,0,0-1.764,1.764v4.5H3.586v-4.5a1.764,1.764,0,0,0-3.528,0v6.269A1.764,1.764,0,0,0,1.822,217.3H20.286a1.764,1.764,0,0,0,1.764-1.764V209.27A1.764,1.764,0,0,0,20.286,207.506Z" transform="translate(-0.058 -207.506)" fill="#fff"/>
</svg>
</span>
</span>	
<p class="folder-wrapper__saved-element--folders-text">Add an external URL of image or upload an image from the device</p>
</figcaption>
</figure>
</div>
</div>
</div>
</div>
</div>
</div>



<div class="tab-pane fade" id="v-pills-garage" role="tabpanel" aria-labelledby="v-pills-garage-tab">
<div class="folder-wrapper">
<div class="desktop-show">
<div class="row mb-2">
<div class="col-8">
<h3 class="folder-wrapper__heading">Title house name 1 - Garage</h3>
</div>
</div>
</div>
<div class="row">
<div class="col-12 js-saved-images-box">
<div class="new-idea-folder-images__wrapper">
<div class="new-idea-folder-images__buttons">
<p class="new-idea-folder-images__empty-text">
No saved files in Garage!
</p>
</div>
<div class="mb-2">
<p class="idea-folder-empty-house__text">You can add them from our website or by adding external images by choosing the option below</p>
</div>
<div class="folder-wrapper__saved-elements">
<figure class="folder-wrapper__saved-element specification-sheet">
<figcaption class="folder-wrapper__saved-element--folders">
<span class="folder-wrapper__saved-element--folders-img">
<svg xmlns="http://www.w3.org/2000/svg" width="24.704" height="16.27" viewBox="0 0 24.704 16.27">
<g id="open-folder-black-and-white-variant" transform="translate(0 -87.578)">
<path id="Path_434" data-name="Path 434" d="M18.618,102.844a1.7,1.7,0,0,0,1.429-.84l4.57-8.648c.273-.526-.124-.84-.84-.84H19.163V90.451a1.3,1.3,0,0,0-1.293-1.293H6.573l-.838-2.2a.59.59,0,0,0-.551-.38H.6a.589.589,0,0,0-.59.593l.011,3.28L0,101.554a1.3,1.3,0,0,0,1.293,1.293m16.69-10.33H7.922a1.392,1.392,0,0,0-1.134.84l-4.109,8.311H1.293a.114.114,0,0,1-.114-.114v-13.8h3.6l.838,2.2a.59.59,0,0,0,.551.38h11.7a.114.114,0,0,1,.114.114v2.066Z" transform="translate(0 1)" fill="#fff"/>
</g>
</svg>
</span>
<div class="folder-wrapper__saved-element--buttons">
<button class="shere">
<svg xmlns="http://www.w3.org/2000/svg" width="23.547" height="25.688" viewBox="0 0 23.547 25.688"><defs><style>.share-white{fill:#fff;}</style></defs><g transform="translate(0)"><path class="share-white" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"/><path class="share-white" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"/><path class="share-white" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"/><path class="share-white" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"/><path class="share-white" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"/><path class="share-white" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"/><path class="share-white" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"/><path class="share-white" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"/></g></svg>
</button>
<button class="delete" data-toggle="modal" data-target="#deleteFolder">
<svg xmlns="http://www.w3.org/2000/svg" width="14.932" height="16.033" viewBox="0 0 14.932 16.033"><defs><style>.trash-white{fill:#fff;}</style></defs><g transform="translate(0 0)"><g transform="translate(0 0)"><g transform="translate(0 0)"><path class="trash-white" d="M63.331,124.769a1.305,1.305,0,0,0,1.351,1.168h5.771a1.328,1.328,0,0,0,1.374-1.191l.939-9.8H62.186Z" transform="translate(-60.01 -109.905)"/><path class="trash-white" d="M27.028,2.061h-4.26V1.328A1.283,1.283,0,0,0,21.533,0H18.577a1.282,1.282,0,0,0-1.306,1.259q0,.035,0,.07v.733h-4.26a.458.458,0,0,0,0,.916H27.028a.458.458,0,1,0,0-.916Zm-5.176-.733v.733H18.188V1.328a.366.366,0,0,1,.389-.412h2.886a.366.366,0,0,1,.391.34A.362.362,0,0,1,21.852,1.328Z" transform="translate(-12.554 0)"/></g></g></g></svg>
</button>
</div>
<p class="folder-wrapper__saved-element--text first">Specification sheet</p>
<button class="folder-wrapper__saved-element--folders-button"><span onClick="open_specs();">open folder</span></button>
</figcaption>
</figure>

<!-- Nice things for -->															
<figure class="folder-wrapper__saved-element folders">
<figcaption class="folder-wrapper__saved-element--folders">
<span class="folder-wrapper__saved-element--folders-img">
<svg xmlns="http://www.w3.org/2000/svg" width="86" height="71.044" viewBox="0 0 86 71.044"><defs><style>.folder-orange{fill:#edb700;}</style></defs><g transform="translate(-10.667)"><g transform="translate(10.667 7.478)"><g transform="translate(0)"><path class="folder-orange" d="M87.319,53.884H44.1a5.6,5.6,0,0,1-5.321-3.836l-.329-.991a9.337,9.337,0,0,0-8.865-6.39H20.015a9.361,9.361,0,0,0-9.348,9.348v44.87a9.358,9.358,0,0,0,9.348,9.348H34.971a1.87,1.87,0,1,0,0-3.739H20.015a5.615,5.615,0,0,1-5.609-5.609V52.015a5.615,5.615,0,0,1,5.609-5.609h9.568A5.6,5.6,0,0,1,34.9,50.239l.333.995a9.337,9.337,0,0,0,8.865,6.39H87.319a5.615,5.615,0,0,1,5.609,5.609V96.884a5.615,5.615,0,0,1-5.609,5.609H72.363a1.87,1.87,0,0,0,0,3.739H87.319a9.356,9.356,0,0,0,9.348-9.348V63.232A9.358,9.358,0,0,0,87.319,53.884Z" transform="translate(-10.667 -42.667)"/></g></g><g transform="translate(14.406)"><path class="folder-orange" d="M101.174,0H41.348A9.361,9.361,0,0,0,32,9.348a1.87,1.87,0,0,0,3.739,0,5.615,5.615,0,0,1,5.609-5.609h59.826a5.615,5.615,0,0,1,5.609,5.609V20.565a1.87,1.87,0,1,0,3.739,0V9.348A9.359,9.359,0,0,0,101.174,0Z" transform="translate(-32)"/></g></g></svg>
</span>
<p class="folder-wrapper__saved-element--folders-text">Nice things for living room</p>
<button class="folder-wrapper__saved-element--folders-button js-show-add-to-rooms-new-idea-folder-images-btn">View folder</button>
</figcaption>
</figure>


<!-- ADD  or Upload Image -->
<figure class="folder-wrapper__saved-element add-new-button js-url-modal-btn" data-tab-parrent="#v-pills-garage" data-button-positon="room-name" data-toggle="modal" data-target="#newImageUrl">
<figcaption class="add-new-button__wrap">
<span class="svg-group">
<span class="svg-group__first">
<svg xmlns="http://www.w3.org/2000/svg" width="34.215" height="51.323" viewBox="0 0 34.215 51.323">
<path id="Path_451" data-name="Path 451" d="M161.684,17.839,146.714.731a2.134,2.134,0,0,0-3.216,0L128.529,17.839a2.137,2.137,0,0,0,1.608,3.546h8.554v27.8a2.139,2.139,0,0,0,2.138,2.138h8.554a2.139,2.139,0,0,0,2.138-2.138v-27.8h8.554a2.137,2.137,0,0,0,1.608-3.546Z" transform="translate(-127.998)" fill="#fff"/>
</svg>
</span>
<span class="svg-group__second">
<svg xmlns="http://www.w3.org/2000/svg" width="21.992" height="9.797" viewBox="0 0 21.992 9.797">
<path id="Path_448" data-name="Path 448" d="M20.286,207.506a1.764,1.764,0,0,0-1.764,1.764v4.5H3.586v-4.5a1.764,1.764,0,0,0-3.528,0v6.269A1.764,1.764,0,0,0,1.822,217.3H20.286a1.764,1.764,0,0,0,1.764-1.764V209.27A1.764,1.764,0,0,0,20.286,207.506Z" transform="translate(-0.058 -207.506)" fill="#fff"/>
</svg>
</span>
</span>
<p class="folder-wrapper__saved-element--folders-text">
Add an external URL of image or upload an image from the device</p>
</figcaption>
</figure>

</div>
</div>
</div>

<div class="col-12 js-specification-sheet-box" style="display: none;">
<div class="folder-wrapper__specification-sheet--wrapper">
<div class="folder-wrapper__specification-sheet--buttons-box">
<div class="folder-wrapper__specification-sheet--buttons-box-content">
<span class="folder-wrapper__specification-sheet--buttons-box-image">
<svg xmlns="http://www.w3.org/2000/svg" width="24.704" height="16.27" viewBox="0 0 24.704 16.27">
<g id="open-folder-black-and-white-variant" transform="translate(0 -87.578)">
<path id="Path_434" data-name="Path 434" d="M18.618,102.844a1.7,1.7,0,0,0,1.429-.84l4.57-8.648c.273-.526-.124-.84-.84-.84H19.163V90.451a1.3,1.3,0,0,0-1.293-1.293H6.573l-.838-2.2a.59.59,0,0,0-.551-.38H.6a.589.589,0,0,0-.59.593l.011,3.28L0,101.554a1.3,1.3,0,0,0,1.293,1.293m16.69-10.33H7.922a1.392,1.392,0,0,0-1.134.84l-4.109,8.311H1.293a.114.114,0,0,1-.114-.114v-13.8h3.6l.838,2.2a.59.59,0,0,0,.551.38h11.7a.114.114,0,0,1,.114.114v2.066Z" transform="translate(0 1)" fill="#fff"/>
</g>
</svg>
</span>
<button class="folder-wrapper__specification-sheet--button js-hide-specification-sheet-box-btn">
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 495.785 495.785" xml:space="preserve"><path id="XMLID_26_" d="M436.855,90.337L255.175,0.541c-1.62-0.801-3.533-0.707-5.084,0.249c-1.535,0.957-2.467,2.638-2.467,4.449  v36.834H56.017v453.713h105.924V147.996h85.684v36.833c0,1.812,0.932,3.492,2.467,4.449c1.551,0.956,3.464,1.052,5.084,0.249  l181.68-89.796c1.791-0.888,2.914-2.706,2.914-4.698C439.769,93.043,438.646,91.225,436.855,90.337z"/><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
Specification sheet
</button>
</div>
<div class="d-flex justify-content-center align-items-center">
<div class="house-checkbox">
<input class="custom-checkbox js-load-confirm-modal" id="checkbox-18" type="checkbox" value="value18" data-target="#confirmModal">
<label for="checkbox-18">Share with Closets To Go</label>
</div>
<button class="folder-wrapper__specification-sheet--button second-button js-hide-specification-sheet-box-btn">
Back
</button>
</div>
</div>
<div class="mt-2 mb-2">
<p class="idea-folder-empty-house__heading">No saved files in 'Nice things for Guest Room folder!</p>
<p class="idea-folder-empty-house__text">You can add them from our website or by adding external images by choosing the option below</p>
</div>
</div>
</div>
f
<div class="col-12 js-add-to-rooms-new-idea-folder-images" style="display: none;">
<div class="new-idea-folder-images__wrapper">
<div class="new-idea-folder-images__buttons">
<div class="new-idea-folder-images__buttons-box-content">
<span class="new-idea-folder-images__buttons-box-image">
<svg xmlns="http://www.w3.org/2000/svg" width="24.704" height="16.27" viewBox="0 0 24.704 16.27">
<g id="open-folder-black-and-white-variant" transform="translate(0 -87.578)">
<path id="Path_434" data-name="Path 434" d="M18.618,102.844a1.7,1.7,0,0,0,1.429-.84l4.57-8.648c.273-.526-.124-.84-.84-.84H19.163V90.451a1.3,1.3,0,0,0-1.293-1.293H6.573l-.838-2.2a.59.59,0,0,0-.551-.38H.6a.589.589,0,0,0-.59.593l.011,3.28L0,101.554a1.3,1.3,0,0,0,1.293,1.293m16.69-10.33H7.922a1.392,1.392,0,0,0-1.134.84l-4.109,8.311H1.293a.114.114,0,0,1-.114-.114v-13.8h3.6l.838,2.2a.59.59,0,0,0,.551.38h11.7a.114.114,0,0,1,.114.114v2.066Z" transform="translate(0 1)" fill="#fff"></path>
</g>
</svg>
</span>
<button class="new-idea-folder-images__button first-button js-hide-add-to-rooms-new-idea-folder-images-btn">
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 495.785 495.785" xml:space="preserve"><path id="XMLID_26_" d="M436.855,90.337L255.175,0.541c-1.62-0.801-3.533-0.707-5.084,0.249c-1.535,0.957-2.467,2.638-2.467,4.449  v36.834H56.017v453.713h105.924V147.996h85.684v36.833c0,1.812,0.932,3.492,2.467,4.449c1.551,0.956,3.464,1.052,5.084,0.249  l181.68-89.796c1.791-0.888,2.914-2.706,2.914-4.698C439.769,93.043,438.646,91.225,436.855,90.337z"></path><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
Nice things for glob...
</button>
</div>
<button class="new-idea-folder-images__button back-btn js-hide-add-to-rooms-new-idea-folder-images-btn">
Back
</button>
</div>
<div class="mt-2 mb-2">
<p class="idea-folder-empty-house__heading">No saved files in 'Nice things for Guest Room folder!</p>
<p class="idea-folder-empty-house__text">You can add them from our website or by adding external images by choosing the option below</p>
</div>
<div class="folder-wrapper__saved-elements">
<figure class="folder-wrapper__saved-element add-new-button js-url-modal-btn" data-tab-parrent="#v-pills-garage" data-button-positon="folder-name" data-toggle="modal" data-target="#newImageUrl">
<figcaption class="add-new-button__wrap">
<span class="svg-group">
<span class="svg-group__first">
<svg xmlns="http://www.w3.org/2000/svg" width="34.215" height="51.323" viewBox="0 0 34.215 51.323">
<path id="Path_451" data-name="Path 451" d="M161.684,17.839,146.714.731a2.134,2.134,0,0,0-3.216,0L128.529,17.839a2.137,2.137,0,0,0,1.608,3.546h8.554v27.8a2.139,2.139,0,0,0,2.138,2.138h8.554a2.139,2.139,0,0,0,2.138-2.138v-27.8h8.554a2.137,2.137,0,0,0,1.608-3.546Z" transform="translate(-127.998)" fill="#fff"/>
</svg>
</span>
<span class="svg-group__second">
<svg xmlns="http://www.w3.org/2000/svg" width="21.992" height="9.797" viewBox="0 0 21.992 9.797">
<path id="Path_448" data-name="Path 448" d="M20.286,207.506a1.764,1.764,0,0,0-1.764,1.764v4.5H3.586v-4.5a1.764,1.764,0,0,0-3.528,0v6.269A1.764,1.764,0,0,0,1.822,217.3H20.286a1.764,1.764,0,0,0,1.764-1.764V209.27A1.764,1.764,0,0,0,20.286,207.506Z" transform="translate(-0.058 -207.506)" fill="#fff"/>
</svg>
</span>
</span>

<p class="folder-wrapper__saved-element--folders-text">Add an external URL of image or upload an image from the device</p>
</figcaption>
</figure>
</div>																										
</div>
</div>
</div>
</div>
</div>

</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</section>
</main>



<div class="scrollToTopBlock">
<div class="people-working">
<img src="<?php echo SITEROOT; ?>images/people-working-call-center_@2x.png" alt="" class="people-working__image">
<div class="people-working__wrapper">
<div class="people-working__content">
<p class="people-working__text">Hi! I'm the Virtual assistant, and I'm here to help you.</p>
</div>
</div>
</div>
<a href="#" class="scrollToTop js-to-top">
<img src="<?php echo SITEROOT; ?>images/arrows.svg" alt="">
</a>
</div>


<?php
require_once($real_root.'/includes/footer.php');
?>





<!-- Modal Add/Edit new folder -->
<div class="modal addEditFolder fade" id="newFolder" tabindex="-1" role="dialog" aria-labelledby="#newFolderTitle" aria-hidden="true">
<div class="modal-dialog modal-sm modal-dialog-centered" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="newFolderTitle">Folder title <span></span></h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
<div class="account-block__form">
<form>
<div class="row mb-3">
<div class="col-12">
<div class="form-group">
<label for="folder-title">Folder title</label>
<input type="text" class="form-control mt-2" name="folder-title" placeholder="Folder title">
</div>
</div>
</div>
<div class="row">
<div class="col-12">
<button type="submit" class="btn btn-primary w-100">confirm</button>
</div>
</div>
</form>
</div>
</div>
</div>
</div>
</div>



<!-- Modal manage saved houses -->
<div class="modal fade" id="specificationsSheetInfo" tabindex="-1" role="dialog" aria-labelledby="#specificationsSheetInfoTitle" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title manage-house-tite" id="specificationsSheetInfoTitle">How to use the "Specifications Sheet"?</h5>

<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body manage-house-modal-body">
<div class="row">
<div class="col-12">
<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Vero distinctio modi excepturi beatae, perspiciatis hic error itaque illo. Provident nobis impedit, dolor consequuntur hic eaque nisi iure minima odio itaque?</p>
<p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Doloremque labore ratione, aliquam voluptates nam vitae dolorum sapiente eveniet impedit harum quia possimus fugit deserunt sit quibusdam dolor eaque veritatis maiores.</p>
<p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Laudantium, atque impedit dolor saepe voluptatem molestiae cupiditate ea totam modi id perspiciatis placeat, deleniti sunt mollitia. Dolores sit totam nobis suscipit.</p>
<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Repudiandae, facilis. Voluptatem, quidem repellendus odio non saepe consectetur cupiditate dignissimos ex officia asperiores aliquam vitae, illum dolore sequi consequatur quibusdam minus!</p>
<p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dignissimos fugiat cum numquam ipsum ullam impedit minus modi iste! Fugiat saepe provident eligendi ex expedita consequatur natus, quos repellat ab aut.</p>
<p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Sunt ipsam deleniti itaque, harum alias aspernatur quisquam nisi? Iusto dolorem, et officiis ad perferendis voluptatem voluptatum possimus temporibus debitis illum odit.</p>
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis pariatur est itaque beatae. Corporis minima voluptas eos dolores, ipsum quae similique, voluptatem voluptates consectetur cumque vero. Cupiditate veniam similique corporis.</p>
<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Vel esse iste expedita? Ipsum, assumenda quod. Facere, repellendus maiores odio labore necessitatibus ratione consequuntur incidunt laudantium distinctio voluptatum impedit, alias maxime!</p>
<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Vero distinctio modi excepturi beatae, perspiciatis hic error itaque illo. Provident nobis impedit, dolor consequuntur hic eaque nisi iure minima odio itaque?</p>
<p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Doloremque labore ratione, aliquam voluptates nam vitae dolorum sapiente eveniet impedit harum quia possimus fugit deserunt sit quibusdam dolor eaque veritatis maiores.</p>
<p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Laudantium, atque impedit dolor saepe voluptatem molestiae cupiditate ea totam modi id perspiciatis placeat, deleniti sunt mollitia. Dolores sit totam nobis suscipit.</p>
<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Repudiandae, facilis. Voluptatem, quidem repellendus odio non saepe consectetur cupiditate dignissimos ex officia asperiores aliquam vitae, illum dolore sequi consequatur quibusdam minus!</p>
<p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dignissimos fugiat cum numquam ipsum ullam impedit minus modi iste! Fugiat saepe provident eligendi ex expedita consequatur natus, quos repellat ab aut.</p>
<p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Sunt ipsam deleniti itaque, harum alias aspernatur quisquam nisi? Iusto dolorem, et officiis ad perferendis voluptatem voluptatum possimus temporibus debitis illum odit.</p>
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis pariatur est itaque beatae. Corporis minima voluptas eos dolores, ipsum quae similique, voluptatem voluptates consectetur cumque vero. Cupiditate veniam similique corporis.</p>
<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Vel esse iste expedita? Ipsum, assumenda quod. Facere, repellendus maiores odio labore necessitatibus ratione consequuntur incidunt laudantium distinctio voluptatum impedit, alias maxime!</p>
</div>
</div>
</div>
</div>
</div>
</div>





<!-- Modal Add new image from URL -->
<div class="modal addEditFolder fade" id="newImageUrl" tabindex="-1" role="dialog" aria-labelledby="#newImageUrlTitle" aria-hidden="true">
<div class="modal-dialog external-url modal-dialog-centered" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="newImageUrlTitle"></h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
<div class="account-block__form">

<form action="<?php echo SITEROOT.'account-idea-folder-details.html' ?>" method="post">
<div class="row mb-3 js-row-url-list">
<div class="col-12">
<div class="form-group">
<label for="image-url">Paste URL here ????</label>
<input type="text" class="form-control mt-2" name="image-url" placeholder="Paste URL here">
</div>
</div>
<div class="col-12 js-add-new-field">
<button type="button" class="add-new-field js-add-new-url-field-btn">
<svg xmlns="http://www.w3.org/2000/svg" width="42.5" height="42.5" viewBox="0 0 42.5 42.5"><defs><style>.add-showroom{fill:#02adb0;}</style></defs><path class="add-showroom" d="M21.25,0A21.25,21.25,0,1,0,42.5,21.25,21.274,21.274,0,0,0,21.25,0Zm9.3,23.021H23.021v7.526a1.771,1.771,0,1,1-3.541,0V23.021H11.953a1.771,1.771,0,0,1,0-3.541h7.526V11.953a1.771,1.771,0,0,1,3.541,0v7.526h7.526a1.771,1.771,0,1,1,0,3.541Zm0,0"/></svg>
Add field
</button>
</div>
</div>

<div class="row mb-3 js-row-field-list">
<div class="col-12">
<div class="new-field-wrap-table">
<div class="row new-field-wrap-table__header">
<hr />
</div>

<div class="row new-field-wrap-table__body">
<div class="col-12">
<div class="row new-field-wrap-table__body--row">

</div>
</div>
</div>

<div class="row new-field-wrap-table__footer">
<div class="col-12">
<div class="drop-input-wrap">
<svg id="add" xmlns="http://www.w3.org/2000/svg" width="28.6" height="28.6" viewBox="0 0 28.6 28.6">
<g id="Group_376" data-name="Group 376">
<path fill="#384765" id="Path_195" data-name="Path 195" d="M14.3,0A14.3,14.3,0,1,0,28.6,14.3,14.316,14.316,0,0,0,14.3,0Zm8.342,14.9a.6.6,0,0,1-.6.6H15.491v6.554a.6.6,0,0,1-.6.6H13.7a.6.6,0,0,1-.6-.6V15.491H6.554a.6.6,0,0,1-.6-.6V13.7a.6.6,0,0,1,.6-.6h6.554V6.554a.6.6,0,0,1,.6-.6H14.9a.6.6,0,0,1,.6.6v6.554h6.554a.6.6,0,0,1,.6.6Z"></path>
</g>
</svg>
Add file or drag and drop image here
<input type="file" name="upload_image[]" id="" class="drop-input" accept="image/*">

</div>
</div>
</div>
</div>
</div>
</div>
<div class="row">
<div class="col-12 text-center">
<button type="submit" class="btn btn-primary js-save-image-url-btr">confirm</button>
</div>
</div>
</form>
</div>
</div>
</div>
</div>
</div>

<?php
$temp_id = time;
?>




<script>
function form_submit(){
	
	if(validate()){

		window.onbeforeunload = null;
		
		var uploader = $('#uploader').pluploadQueue();
		
		if (uploader.files.length > 0) {
            
			// When all files are uploaded submit form
            uploader.bind('StateChanged', function() {
                if (uploader.files.length === (uploader.total.uploaded + uploader.total.failed)) {
                    
					document.form.submit();
					
                }
            });
                
            uploader.start();
			
        } else {
            //alert('You must queue at least one file.');
			
			document.form.submit();
			
        }
		
		//document.form.submit();
		
	}else{
	
	}
}
 	


$(function() {
	
	// Setup html5 version
	$("#uploader").pluploadQueue({
		// General settings
		runtimes : 'html5,flash,silverlight,html4',
		url : '<?php echo SITEROOT; ?>/plupload-2.1.8/otg/upload.php?temp_id='+<?php echo $temp_id; ?>,
		chunk_size: '1mb',
		rename : true,
		dragdrop: true,
		filters : {
			// Maximum file size
			max_file_size : '10mb',
			// Specify what files to browse for
			mime_types: [
				{title : "Image files", extensions : "jpg,jpeg,gif,png,pdf"},
				{title : "Zip files", extensions : "zip"}
			]
		},


		flash_swf_url : '<?php echo SITEROOT; ?>/plupload-2.1.8/js/Moxie.swf',
		silverlight_xap_url : '<?php echo SITEROOT; ?>/plupload-2.1.8/js/Moxie.xap'
	});
	
	var uploader = $('#uploader').pluploadQueue();
	
	uploader.bind('FileUploaded', function() {
		if (uploader.files.length == (uploader.total.uploaded + uploader.total.failed)) {
			$("#submit_sendto").show();
        }else{
			$("#submit_sendto").hide();
		}
	});
	
	uploader.bind('UploadProgress', function(up, file) {
    
        if(file.percent < 100 && file.percent >= 1){
			$("#submit_sendto").hide();
        }else{
			//$("#submit_sendto").show();
        }                               
    });


});

</script>

<script src="<?php echo SITEROOT; ?>app.js"></script>

</body>
</html>



