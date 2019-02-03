//some global variables

//create cube geometry
var geometry = new THREE.BoxGeometry(1);
var material = new THREE.MeshPhongMaterial( {color: 0x222222});

//Create cubes
var box = new THREE.Mesh(geometry, material);
var box1 = new THREE.Mesh(geometry, material);
var box2 = new THREE.Mesh(geometry, material);


var horizontalStart = window.innerWidth * 0.85;
var verticalStart = window.innerHeight / 2;

//delay window opening to window load
window.onload = function(){

  //create scene and camera
  var scene = new THREE.Scene();
  var camera = new THREE.PerspectiveCamera(70, (window.innerWidth / 3) / window.innerHeight, 0.1, 1000);

  //create and append renderer
  var renderer = new THREE.WebGLRenderer({alpha: true, antialias: true, canvas: dingo});
  renderer.setSize(window.innerWidth / 3, window.innerHeight);
  document.body.appendChild(renderer.domElement);



  //reposition cubes
  box.position.set(0,-4,0);
  box.rotation.x = -0.35;
  box1.position.set(0,4,0);
  box1.rotation.x = 0.35;
  box2.position.set(0,0,0);

  //add some lights
  ambientLight = new THREE.AmbientLight(0xFFFFFF,1);
  pointLight = new THREE.PointLight(0xFFFFFF,8,6.3);
  pointLight1 = new THREE.PointLight(0xFFFFFF,8,6.3);
  pointLight2 = new THREE.PointLight(0xFFFFFF,8,6.3);

  //customize lights
  pointLight.position.set(0,0,6);
  pointLight.castShadow = true;
  pointLight.shadow.camera.near = 1;
  pointLight.shadow.camera.far = 1;
  pointLight1.position.set(0,-4,6);
  pointLight1.castShadow = true;
  pointLight1.shadow.camera.near = 1;
  pointLight1.shadow.camera.far = 1;
  pointLight2.position.set(0,4,6);
  pointLight2.castShadow = true;
  pointLight2.shadow.camera.near = 1;
  pointLight2.shadow.camera.far = 1;

  //add everything to scene
  scene.add(box,box1,box2,pointLight,pointLight1,pointLight2,ambientLight);

  camera.position.z = 10;

  renderer.shadowMap.enabled = true;
  renderer.shadowMap.type = THREE.BasicShadowMap;

  function animate(){
    requestAnimationFrame(animate);
    renderer.render(scene,camera);
  }

  animate();

  document.onmousemove = cubes;

};

function cubes(event){
  event = event || window.event;

  box.rotation.y = ((event.pageX - horizontalStart) / 3000);
  box1.rotation.y = ((event.pageX - horizontalStart) / 3000);
  box2.rotation.y = ((event.pageX - horizontalStart) / 3000);

  box.rotation.x = ((event.pageY - verticalStart) / 3000) - 0.35;
  box1.rotation.x = ((event.pageY - verticalStart) / 3000) + 0.35;
  box2.rotation.x = ((event.pageY - verticalStart) / 3000);


}

function getMousePosition(){
  var position = mousePositions;
}
