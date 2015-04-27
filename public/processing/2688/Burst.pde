class Burst {
  
 float angle, size, noi, bend, trans; 
 int depth, more, evenMore;
 
 Burst(float a, float b, float s, int d, float n) {
    angle = a;
    bend = b;
    size = s;
    depth = d;
    noi = n;
    more = round(random(0,6));
    evenMore = round(random(0,6));
    trans = random(20,100);
 }

 void update() {
   noi += 0.005;
 }
 
 void paint() {
   pushMatrix();
     rotate(angle);
     burst(depth);
   popMatrix();
 }

 void burst(int d) {
   pushMatrix();
    rotate(noise(noi)*2*radians(bend));
    strokeWeight(2);
    stroke(#222222, trans);
    line(0, 0, size, 0);
      
    burstMore(more);
      
    noStroke();
    fill(200,200);
    translate(size, 0);
    if(d>0) {
      burst(d-1);
    }
   popMatrix();
 }
 
 void burstMore(int d) {
  strokeWeight(2);
  pushMatrix();
    rotate(radians(bend/2));
    line(0,0,size/2,0);
    
    burstEvenMore(evenMore);
    translate(size/8,0);
    if(d>0) {
      burstMore(d-1);
    }
  popMatrix();
 }
 
 void burstEvenMore(int d) {
  if(d > 0) {
    pushMatrix();
      strokeWeight(1);
      rotate(noise(noi)*radians(bend*3));
      line(0,0,size/8,0);
      translate(size/8,0);
      burstEvenMore(d-1);
    popMatrix();
  }
 }
}
