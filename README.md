<h1>README</h1>
<hr>
<h3>Tools used</h3>
<ul>
    <li>PhpStorm</li>
    <li>Docker</li>
    <li>DDEV</li>
</ul>

<hr>
<h3>Setup</h3>
<p>You only need to have ddev installed on your machine, the .ddev/config.yaml should not be changed</p>
<p>Start the Project via the "ddev start" within the project directory</p>
<hr>

<h3>How to use CLI</h3>
<p>As soon as the ddev project is running, type "ddev ssh".

The entrypoint to this CLI tool lies within bin/console.

<b>Before using the CLI, please type "php bin/console init" to initialize the project.</b>
</p>
<hr>

<h3>Commands</h3>
<ul>
    <li><b>php bin/console init</b>:  initalizes the project and creates the necessary database tables</li>
    <li><b>php bin/console help</b>: lists all existing commands</li>
    <li><b>php bin/console convert</b>: lists all existing convert methods</li>
    <li><b>php bin/console convert catalog $filePath(starts from project root)</b>: converts the given feed.xml structure and insert not existing data/updates existing data</li>
</ul>
<hr>

<h3>Explanation</h3>
<p>
For this project i haven't used anything besides pure PHP, since i wanted it to be more of a challenge and also show,
what i could do on my own without any help from external libraries and frameworks.
I also tried to keep it as dynamic as possible, as you can see with the way you can add converters or commands to the CLI Tool without a big hassle.
</p>
<hr>