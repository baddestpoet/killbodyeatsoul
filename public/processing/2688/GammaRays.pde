float length, oldLength, noi, angle;
int steps, burstCount;

Burst bursts[];

void setup() {
  size(695, 695);
  background(#222222);
 
  reset();
}

void draw() {
  background(#EEEEEE);
  noi += 0.005;
  translate(width/2, height/2);

  for (int i=0;i<burstCount;i++) {
    bursts[i].update();
    bursts[i].paint();
  }
}

void mouseClicked() {
  reset();
}

void reset() {
  burstCount = round(random(3,50));
  bursts = new Burst[burstCount];
  float phi = round(360/(burstCount-1));
  for (int i=0;i<burstCount;i++) {
    bursts[i] = new Burst((i+1)*phi, random(5,60), random(30,150), round(random(1,5)), random(0,0.1));
  }
}
