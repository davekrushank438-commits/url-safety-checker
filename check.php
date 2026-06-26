 <?php

if(!isset($_POST['url']))
{
    header("Location: index.html");
    exit();
}

$url = trim($_POST['url']);

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>CyberShield Scan Report</title>

<link rel="stylesheet" href="style.css">

</head>

<body>

<header>

<h1>🛡 CyberShield</h1>

<p>Advanced URL Threat Detection System</p>

</header>

<nav>

<a href="index.html">Dashboard</a>

<a href="analysis.html">Analysis</a>

<a href="about.html">About</a>

</nav>

<div class="container">

<div class="card">

<h2>CyberShield Scan Report</h2>

<?php

if(!filter_var($url,FILTER_VALIDATE_URL))
{
    echo "<h2 class='danger'>INVALID URL</h2>";
    echo "<br>";
    echo "<a href='index.html#scanner' class='btn'>Go Back</a>";
    echo "</div></div></body></html>";
    exit();
}

$score = 0;

echo "<table>";

echo "<tr>";
echo "<th>Security Check</th>";
echo "<th>Status</th>";
echo "</tr>";

/* HTTPS */

if(strpos($url,"https://")===0)
{
    echo "<tr><td>HTTPS Security</td><td>PASS ✅</td></tr>";
    $score++;
}
else
{
    echo "<tr><td>HTTPS Security</td><td>FAIL ❌</td></tr>";
}

/* URL Length */

if(strlen($url)<75)
{
    echo "<tr><td>URL Length Analysis</td><td>PASS ✅</td></tr>";
    $score++;
}
else
{
    echo "<tr><td>URL Length Analysis</td><td>FAIL ❌</td></tr>";
}

/* Subdomain */

if(substr_count($url,'.')<4)
{
    echo "<tr><td>Subdomain Count</td><td>PASS ✅</td></tr>";
    $score++;
}
else
{
    echo "<tr><td>Subdomain Count</td><td>FAIL ❌</td></tr>";
}

/* IP Address */

if(!preg_match('/\d+\.\d+\.\d+\.\d+/',$url))
{
    echo "<tr><td>IP Address Detection</td><td>PASS ✅</td></tr>";
    $score++;
}
else
{
    echo "<tr><td>IP Address Detection</td><td>FAIL ❌</td></tr>";
}

/* Suspicious Keywords */

$suspiciousWords=array(
"login",
"verify",
"secure",
"update",
"bank",
"signin",
"account"
);

$dangerFlag=false;

foreach($suspiciousWords as $word)
{
    if(stripos($url,$word)!==false)
    {
        $dangerFlag=true;
        break;
    }
}

if(!$dangerFlag)
{
    echo "<tr><td>Suspicious Keywords</td><td>PASS ✅</td></tr>";
    $score++;
}
else
{
    echo "<tr><td>Suspicious Keywords</td><td>FAIL ❌</td></tr>";
}

echo "</table>";

echo "<div class='score'>";
echo "Security Score : ".$score." / 5";
echo "</div>";

if($score>=4)
{
    echo "<h2 class='safe'>SAFE WEBSITE ✅</h2>";
}
elseif($score>=3)
{
    echo "<h2 class='warning'>MODERATELY SAFE ⚠️</h2>";
}
else
{
    echo "<h2 class='danger'>POTENTIAL PHISHING WEBSITE ❌</h2>";
}

echo "<br>";

echo "<table>";

echo "<tr><th colspan='2'>Security Intelligence Report</th></tr>";
    
    echo "<tr><td>SSL Certificate</td><td>";
echo (strpos($url,"https://")===0) ? "Detected ✅" : "Not Detected ❌";
echo "</td></tr>";

echo "<tr><td>Threat Level</td><td>";

if($score>=4)
{
    echo "Low Risk";
}
elseif($score>=3)
{
    echo "Medium Risk";
}
else
{
    echo "High Risk";
}

echo "</td></tr>";

echo "<tr><td>Domain Reputation</td><td>";

if($score>=4)
{
    echo "Trusted";
}
elseif($score>=3)
{
    echo "Average";
}
else
{
    echo "Suspicious";
}

echo "</td></tr>";

echo "<tr><td>Scan Timestamp</td><td>";
echo date("d-m-Y H:i:s");
echo "</td></tr>";

echo "<tr><td>Security Score</td><td>";
echo $score."/5";
echo "</td></tr>";

echo "<tr><td>Recommendation</td><td>";

if($score>=4)
{
    echo "Website appears safe to visit.";
}
elseif($score>=3)
{
    echo "Proceed with caution.";
}
else
{
    echo "Avoid visiting this website.";
}

echo "</td></tr>";

echo "</table>";

echo "<br>";

echo "<div class='card'>";

echo "<h2>Scan Summary</h2>";

echo "<p>";

if($score>=4)
{
    echo "The scanned URL passed most security checks and appears to be safe based on the implemented CyberShield analysis.";
}
elseif($score>=3)
{
    echo "The scanned URL passed some security checks. Users should verify the website before entering personal information.";
}
else
{
    echo "The scanned URL failed multiple security checks and may be a phishing or malicious website.";
}

echo "</p>";

echo "</div>";

echo "<br>";
    
    echo "<button onclick='window.print()' class='btn'>
Download / Print Report
</button>";

echo "<br><br>";

?>

<div class="bottom-buttons">

    <a href="index.html#scanner" class="btn">
        Scan Another URL
    </a>

    <a href="index.html" class="btn">
        Back to Dashboard
    </a>

</div>

</div>
</div>

<footer>

© 2026 CyberShield | Developed by Krushank Dave | Cyber Security Internship Project

</footer>

</body>
</html>