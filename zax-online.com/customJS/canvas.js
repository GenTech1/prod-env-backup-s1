
const camDis = 5, cSize = {w:window.innerWidth, h:500};

var camera, scene, renderer, controls, light, totalGroup;

$( document ).ready(function() {
	init();
	loadModel();
	animate();
});

function init() {
	renderer = new THREE.WebGLRenderer({antialias:true});
	renderer.setSize(cSize.w, cSize.h);
	document.getElementById("container").appendChild(renderer.domElement);
	renderer.setClearColor(0xCCCCCC, 1);
	
	camera = new THREE.PerspectiveCamera(60, cSize.w / cSize.h, 0.1,  100);
	camera.position.set(0, camDis/4, camDis * 1.2);

	controls = new THREE.OrbitControls(camera, renderer.domElement);

	scene = new THREE.Scene();
	totalGroup = new THREE.Group(); scene.add(totalGroup);

	const ambient = new THREE.AmbientLight(0xFFFFFF, 0.3); scene.add(ambient);
	const light = new THREE.DirectionalLight( 0xFFFFFF, 0.7); scene.add(light);
}

function loadModel() {
	const loader = new THREE.GLTFLoader();
	const dracoLoader = new THREE.DRACOLoader(), dracoPath = 'https://www.gstatic.com/draco/v1/decoders/';
	dracoLoader.setDecoderPath(dracoPath);
	loader.setDRACOLoader(dracoLoader);
    loader.load('/model/test.glb', function ( gltf ) {
	    scene.add( gltf.scene );
	}, undefined, function ( error ) {
		console.error( error );
	} );
}

function animate() {
	if (camera && scene) {
		renderer.render(scene, camera);
	}
	requestAnimationFrame(animate);
}
