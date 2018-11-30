/**
 * 3D
 */

 //1.创建一个场景（场景是一个容器，用于保存、跟踪所要渲染的物体和使用的光源）
var scene = new THREE.Scene();

//2.创建一个光源
var light = new THREE.DirectionalLight(0xffffff);
light.position.set(1, 1, 1).normalize();
scene.add(light);

//3.创建一个摄像机对象（摄像机决定了能够在场景里看到什么）
var camera = new THREE.PerspectiveCamera(45, window.innerWidth / window.innerHeight, 0.1, 1000);
//3.1.设置摄像机的位置，并让其指向场景的中心（0,0,0）
camera.position.x = -30;
camera.position.y = 40;
camera.position.z = 30;
camera.lookAt(scene.position);

//4.创建一个WebGL渲染器并设置其大小
var renderer = new THREE.WebGLRenderer();
renderer.setClearColor(new THREE.Color(0xEEEEEE));
renderer.setSize(600, 200);


//在场景中添加坐标轴
var axes = new THREE.AxesHelper(20);
scene.add(axes);

//创建一个平面
var planeGeometry = new THREE.PlaneGeometry(60, 20);
//平面使用颜色为0xcccccc的基本材质
var planeMaterial = new THREE.MeshBasicMaterial({color: 0xcccccc});
var plane = new THREE.Mesh(planeGeometry, planeMaterial);
//设置屏幕的位置和旋转角度
plane.rotation.x = -0.5 * Math.PI;
plane.position.x = 15;
plane.position.y = 0;
plane.position.z = 0;

//将平面添加场景中
scene.add(plane);

//创建一个立方体
var boxGeometry = new THREE.BoxGeometry(6, 6, 6);
//将线框（wireframe）属性设置为true，这样物体就不会被渲染为实物物体
var boxMaterial = new THREE.MeshBasicMaterial({color: 0xff0000, wireframe: true});
var boxMesh = new THREE.Mesh(boxGeometry, boxMaterial);
//设置立方体的位置
boxMesh.position.x = 0;
boxMesh.position.y = 0;
boxMesh.position.z = 0;
//将立方体添加到场景中
scene.add(boxMesh);


//创建一个球体
var sphereGeometry = new THREE.SphereGeometry(10, 10, 10);
//将线框（wireframe）属性设置为true，这样物体就不会被渲染为实物物体
var sphereMaterial = new THREE.MeshBasicMaterial({color: 0x7777ff, wireframe: true});

var sphereMesh = new THREE.Mesh(sphereGeometry, sphereMaterial);

//设置球体的位置
sphereMesh.position.x = 0;
sphereMesh.position.y = 4;
sphereMesh.position.z = 2;

//将球体添加到场景中
scene.add(sphereMesh);

//将渲染的结果输出到指定页面元素中
//document.getElementById("example").appendChild(renderer.domElement);

var flag = true;

function renderLoop(){
    requestAnimationFrame(renderLoop);
    boxMesh.rotation.set(
      0,
      boxMesh.rotation.y + 0.02,
      boxMesh.rotation.z + 0.02
    );

    sphereMesh.rotation.set(
        0,
        sphereMesh.rotation.y + 0.02,
        sphereMesh.rotation.z + 0.02
    );

    /*
    if(camera.position.z >= 90){
        flag = false;
    } else if(camera.position.z  <= 10) {
        flag = true;
    }
    */
//    camera.position.z = camera.position.z + (flag ? 0.1 : -0.1 );
    renderer.render(scene,camera);
}


