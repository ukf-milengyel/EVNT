// options
const sf = 1; // scale factor
const fps = 40;

// canvas
const canvas = document.getElementById("canvas");
canvas.width = Math.floor(canvas.scrollWidth / sf);
canvas.height = Math.floor(canvas.scrollHeight / sf);
const ctx = canvas.getContext("2d");
let w,h,wh,hh;
let bordertop,borderleft,borderright,borderbottom;

// timer
const interval = Math.round(1000/fps);
let now, delta;
let then = Date.now();

const pi2 = Math.PI*2;

let particles;
const numberOfParticles = 50;
const minSize = 2;
const maxSize = 40 / sf;
const maxSpeed = 1;
const speedChangeThreshold = maxSpeed / 2;

let lerpamt = 0.01 / sf;

// alpha stuff
const minAlpha = 0;
const maxAlpha = 0.2;
const mapConst = (maxAlpha - minAlpha) / (maxSize - minSize);

function loop(){
    requestAnimationFrame(loop);
    now = Date.now();
    delta = now - then;
    if (delta < interval) return;
    then = now - (delta % interval);

    draw();
}

function draw(){
    ctx.clearRect(0,0,w,h);

    for (const particle of particles){
        // position
        particle.x = particle.x + particle.xaccel;
        particle.y = particle.y + particle.yaccel;

        // check bounds
        if (particle.x > borderright) particle.x = borderleft;
        else if (particle.x < borderleft) particle.x = borderright;
        if (particle.y > borderbottom) particle.y = bordertop;
        else if (particle.y < bordertop) particle.y = borderbottom;

        // go to target size
        particle.size = lerp(particle.size, particle.sizeTarget, lerpamt);
        if (Math.abs(particle.size - particle.sizeTarget) < 1) particle.sizeTarget = rng(minSize, maxSize);

        // go to target accel
        particle.xaccel = lerp(particle.xaccel, particle.xaccelTarget, lerpamt);
        if (Math.abs(particle.xaccel - particle.xaccelTarget) < speedChangeThreshold) particle.xaccelTarget = rng(-maxSpeed, maxSpeed);
        particle.yaccel = lerp(particle.yaccel, particle.yaccelTarget, lerpamt);
        if (Math.abs(particle.xaccel - particle.yaccelTarget) < speedChangeThreshold) particle.yaccelTarget = rng(-maxSpeed, maxSpeed);

        ctx.beginPath();

        const alpha = maxAlpha - (minAlpha + mapConst * (particle.size - minSize));
        ctx.fillStyle = "rgba(255,255,255, "+alpha+")";

        ctx.ellipse(particle.x + particle.size, particle.y + particle.size, particle.size, particle.size, 0, 0, pi2);
        ctx.fill();
    }


}


function restart(){
    // init function
    canvas.width = Math.floor(canvas.scrollWidth / sf);
    canvas.height = Math.floor(canvas.scrollHeight / sf);
    w = canvas.width;
    h = canvas.height;

    bordertop = - maxSize*2;
    borderbottom = h + maxSize*2;
    borderleft = - maxSize*2;
    borderright = w + maxSize*2;

    particles = [];
    for (let i = 0; i < numberOfParticles; i++){
        particles.push({
            x: rng(borderleft, borderright),
            y: rng(bordertop, borderbottom),
            xaccel: rng(-maxSpeed, maxSpeed),
            yaccel: rng(-maxSpeed, maxSpeed),
            xaccelTarget: rng(-maxSpeed, maxSpeed),
            yaccelTarget: rng(-maxSpeed, maxSpeed),
            size: maxSize,
            sizeTarget: rng(minSize, maxSize)
        });
    }

    loop();
}

function rng(min, max){
    return Math.random() * (max - min) + min;
}

function lerp (start, end, amt){
    return (1-amt)*start+amt*end;
}

window.addEventListener('resize', ()=>{
    restart();
});

restart();