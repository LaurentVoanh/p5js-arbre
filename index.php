<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Random Tree with p5.js</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/1.4.0/p5.js"></script>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #ffffff;
        }
    </style>
</head>
<body>
    <script>
        function setup() {
            createCanvas(710, 400);
            colorMode(HSB);
            angleMode(DEGREES);
            noLoop(); // Stop the draw loop after the first frame
        }

        function draw() {
            background(255); // White background

            // Start the tree from the bottom of the screen
            translate(width / 2, height);

            // Draw a line with a random length between 100 and 150 pixels
            let initialLength = random(100, 150);
            stroke(random(255), 255, 255);
            line(0, 0, 0, -initialLength);

            // Draw curves around the line
            drawCurves(0, 0, 0, -initialLength);

            // Move to the end of that line
            translate(0, -initialLength);

            // Start the recursive branching
            branch(initialLength, 0);

            describe(
                'A tree drawn by recursively drawing branches, with random angles and colors.'
            );
        }

        function branch(h, level) {
            // Each branch will be a random size between 0.5 and 0.8 of the previous one
            h *= random(0.5, 0.8);

            // Draw if our branch length > 2, otherwise stop the recursion
            if (h > 2) {
                // Draw the right branch
                // Save the current coordinate system
                push();

                // Rotate by a random angle between -45 and 45 degrees
                rotate(random(-45, 45));

                // Set a random color for the branch
                stroke(random(255), 255, 255);

                // Draw the branch
                line(0, 0, 0, -h);

                // Draw curves around the branch
                drawCurves(0, 0, 0, -h);

                // Move to the end of the branch
                translate(0, -h);

                // Call branch() recursively
                branch(h, level + 1);

                // Restore the saved coordinate system
                pop();

                // Draw the left branch
                push();
                rotate(random(-45, 45));
                stroke(random(255), 255, 255);
                line(0, 0, 0, -h);

                // Draw curves around the branch
                drawCurves(0, 0, 0, -h);

                translate(0, -h);
                branch(h, level + 1);
                pop();
            }
        }

        function drawCurves(x1, y1, x2, y2) {
            stroke(random(255), 255, 255, 100); // Different color for curves
            for (let i = 0; i < 8; i++) {
                let angle = i * 45;
                let controlX1 = x1 + cos(angle) * 10;
                let controlY1 = y1 + sin(angle) * 10;
                let controlX2 = x2 + cos(angle) * 10;
                let controlY2 = y2 + sin(angle) * 10;
                bezier(x1, y1, controlX1, controlY1, controlX2, controlY2, x2, y2);
            }
        }

        function mousePressed() {
            redraw(); // Redraw the tree when the mouse is pressed
        }
    </script>
</body>
</html>
