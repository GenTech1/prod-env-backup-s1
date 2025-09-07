window["initScene"] = initScene;
let scene,camera,renderer,cube;
let pcShellModel="",root;
let controls,container;
let raycaster, mouse,selectedObj,bboxHelper = null;;
const SCALE=2;
const panel_name = {top_front:"top_front",bottom_front:"bottom_front",right:"right_panel",left:"left_panel",top:"top_panel",back:"back_panel"}
function initScene(){
    container  = document.getElementById("3d_container");
    scene = new THREE.Scene();
    scene.background = new THREE.Color( 0xbfe3dd );
    camera = new THREE.PerspectiveCamera(75, container.clientWidth / container.clientHeight, 0.1, 1000);
    camera.position.set( .2, 5, 10);
    renderer = new THREE.WebGLRenderer();
    
    renderer.setSize(container.clientWidth, container.clientHeight);
    renderer.outputColorSpace = THREE.SRGBColorSpace;
    renderer.setPixelRatio(window.devicePixelRatio);
    container.appendChild(renderer.domElement);
    controls = new THREE.OrbitControls(camera, renderer.domElement);
    controls.target.set(.2, 0,0);
    controls.minDistance =.8;
    controls.maxDistance =1.7;
    controls.enablePan = false;
    controls.zoomSpeed=.35;
    controls.update();
    raycaster  = new THREE.Raycaster();
    mouse      = new THREE.Vector2();
    // document.addEventListener('click', mouseClick, false);
    container.addEventListener('pointerdown', mouseClick, false);
    // const geometry = new THREE.BoxGeometry();
    // const material = new THREE.MeshBasicMaterial({ color: 0x00ff00 });
    // cube = new THREE.Mesh(geometry, material);
    root = new THREE.Object3D();
    root.position.set(0,-.25,-.5);
    scene.add(root);
    const hemiLight1 = new THREE.HemisphereLight(0xffffff,0xffffff,.5);
    hemiLight1.position.set(0,10,0);
    scene.add(hemiLight1);
    const dir1 = new THREE.DirectionalLight(0xffffff,1);
    dir1.position.set(1,2,2);
    const target1 = new THREE.Object3D();
    target1.position.set(0,1,0);
    scene.add(target1);
    dir1.target = target1;
    scene.add(dir1);
    const dir2 = new THREE.DirectionalLight(0xffffff,1);
    dir2.position.set(-1,2,-2);
    const target2 = new THREE.Object3D();
    target2.position.set(0,1,0);
    scene.add(target2);
    dir2.target = target2;
    scene.add(dir2);
    loadModel();

    // createPlaneRaycast();
    // scene.add( plane );
    animate();
    
}
function createPlaneRaycast(){
    const geometry = new THREE.BoxGeometry(1,1, 1 );
    const material = new THREE.MeshBasicMaterial( {color: 0xffff00, side: THREE.DoubleSide} );
    // material.alphaTest=.5;
    // material.opacity=0;
    // const front_plane = new THREE.Mesh( geometry, material );
    // front_plane.name = panel_name.top_front;
    // front_plane.position.set(0.2,0.35,0.38);
    // front_plane.scale.set(0.192*SCALE,0.113*SCALE,.01);
    // scene.add(front_plane);

    // const front_plane2 = new THREE.Mesh( geometry, material );
    // front_plane2.name = panel_name.bottom_front;
    // front_plane2.position.set(0.2,-.009,0.38);
    // front_plane2.scale.set(0.192*SCALE,0.238*SCALE,.01);
    // scene.add(front_plane2);

    const right_side_plane = new THREE.Mesh( geometry, material );
    right_side_plane.name = panel_name.right;
    right_side_plane.position.set(0.42,0.14,-.06);
    right_side_plane.scale.set(0.02,0.31*SCALE,0.411*SCALE);
    scene.add(right_side_plane);

    // const left_side_plane = new THREE.Mesh( geometry, material );
    // left_side_plane.name = panel_name.left;
    // left_side_plane.position.set(-0.05,0.14,-.06);
    // left_side_plane.scale.set(0.02,0.31*SCALE,0.411*SCALE);
    // scene.add(left_side_plane);

    const top_side_plane = new THREE.Mesh( geometry, material );
    top_side_plane.name = panel_name.top;
    top_side_plane.position.set(0.20,0.49,-.07);
    top_side_plane.scale.set(0.212*SCALE,0.01,0.446*SCALE);
    scene.add(top_side_plane);


    const back_side_plane = new THREE.Mesh( geometry, material );
    back_side_plane.name = panel_name.back;
    back_side_plane.position.set(0.20,0.139,-.53);
    back_side_plane.scale.set(0.222*SCALE,0.354*SCALE,0.01);
    scene.add(back_side_plane);

    const pos = {x:0,y:0,z:0,val:.01};
    document.addEventListener("keydown",(e)=>{
         const keycode =e.key;
        //  console.log(keycode);
         switch(keycode){
            case "ArrowLeft":
                 pos.x -= pos.val;
                break;
            case "ArrowRight":
                 pos.x += pos.val;
                break;
            case "3":
                 pos.y += pos.val;
                break;
            case "4":
                 pos.y -= pos.val;
                break;
            case "1":
                 pos.z -= pos.val;
                break;
            case "2":
                 pos.z += pos.val;
                break;
         }
        //  back_side_plane.position.set(pos.x,pos.y,pos.z);
        //  console.log(pos);
         
    })
}

function loadModel(){
    const manager    = new THREE.LoadingManager();
    const gltfLoader = new THREE.GLTFLoader(manager);
    gltfLoader.load('model/case_JONSBO_D31_upd05.glb', (gltf )=>{
            pcShellModel = gltf.scene;
            pcShellModel.position.set(0,0,0);
            pcShellModel.rotation.set(0,0,0);
            pcShellModel.scale.set(SCALE,SCALE,SCALE);
            root.add(pcShellModel);
            pcShellModel.traverse( function (child){
                // console.log(child.isRayCast)
            });

            // scene.add(object3d.scene);
        }, undefined, function ( error ) {
            console.error( error );
        } 
    );
    manager.onStart = (url, itemsLoaded, itemsTotal) => {
        document.getElementById("loader").style.display = "block";
      };
    manager.onLoad = () => {
        document.getElementById("loader").style.display = "none";
    };
    document.getElementById("color_input").addEventListener("input",(e)=>{
        //  console.log("   ",document.getElementById("color_input").value)
         const color = document.getElementById("color_input").value;
         if(selectedObj.children.length>0){
            selectedObj.children.forEach(child => {
                    if(child.isMesh){
                        child.material.color.set(color);
                        // console.log(child.name);
                    }
            });
      }
      else{
        //  console.log(selectedObj);
         selectedObj.material.color.set(color);
      }
    })
 
}
function animate() {
    requestAnimationFrame(animate);
    renderer.render(scene, camera);
}
window.onresize = function () {
    camera.aspect = container.clientWidth / container.clientHeight;
    camera.updateProjectionMatrix();
    renderer.setSize( container.clientWidth, container.clientHeight);
};

function mouseClick(event){
    event.preventDefault();
    // mouse.x =  (event.clientX / container.clientWidth ) * 2 - 1;
    // mouse.y = -(event.clientY / container.clientHeight ) * 2 + 1;
    
    if(bboxHelper)
        scene.remove(bboxHelper);
    const rect = renderer.domElement.getBoundingClientRect();
    mouse.x = ( ( event.clientX - rect.left ) / ( rect. right - rect.left ) ) * 2 - 1;
    mouse.y = - ( ( event.clientY - rect.top ) / ( rect.bottom - rect.top) ) * 2 + 1;
    raycaster.setFromCamera(mouse, camera);
    const intersects = raycaster.intersectObjects(scene.children,true);
    
    if (intersects.length > 0) {
        console.log(intersects[1].object.name,"      ","mouseClick");
         selectedObj = intersects[0].object;
         document.getElementById("color_input").style.display = "block";
        // getObject(intersects[0].object);
        const bbox = new THREE.Box3().setFromObject(intersects[0].object);
        bboxHelper = new THREE.Box3Helper(bbox, 0xffff00);
        scene.add(bboxHelper);
        // intersects[0].object.material.color.set(0x000000);
    } else {
        document.getElementById("color_input").style.display = "none";
    }
}
function getObject(name){
      console.log("getObject",name);
      switch(name){
         case panel_name.top_front:
            pcShellModel.traverse( function (child){
                if(child.name === "front_panel_2"){
                    selectedObj = child;
                    return;
                }
            });
            // console.log("&&&&&&&&&&")
            // console.log(selectedObj);
            break;
        case panel_name.bottom_front:
            pcShellModel.traverse( function (child){
                if(child.name === "front_panel_1"){
                    selectedObj = child;
                    return;
                }
            });
            break;
        case panel_name.right:
            pcShellModel.traverse( function (child){
                if(child.name === "right_panel"){
                    selectedObj = child;
                    return;
                }
            });
            break;
        case panel_name.left:
            pcShellModel.traverse( function (child){
                if(child.name === "left_panel"){
                    selectedObj = child;
                    return;
                }
            });
            break;
        case panel_name.top:
            pcShellModel.traverse( function (child){
                if(child.name === "top_panel"){
                    selectedObj = child;
                    return;
                }
            });
            break;
      }  
      document.getElementById("color_input").style.display = "block";
    //   if(selectedObj.children.length>0){
    //         selectedObj.children.forEach(child => {
    //                 if(child.isMesh){
    //                     child.material.color.set(0xff0000);
    //                     console.log(child.name);
    //                 }
    //         });
    //   }
    //   else{
    //      console.log(selectedObj);
    //      selectedObj.material.color.set(0x000000);
    //   }
}


