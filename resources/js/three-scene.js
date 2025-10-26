import * as THREE from 'three';

let scene, camera, renderer, particles, animationId;

function initThreeScene() {
    const canvas = document.getElementById('three-canvas');
    if (!canvas) return;

    // Scene setup
    scene = new THREE.Scene();
    
    // Camera setup
    const width = canvas.clientWidth;
    const height = canvas.clientHeight;
    camera = new THREE.PerspectiveCamera(75, width / height, 0.1, 1000);
    camera.position.z = 5;

    // Renderer setup
    renderer = new THREE.WebGLRenderer({
        canvas: canvas,
        alpha: true,
        antialias: true
    });
    renderer.setSize(width, height);
    renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));

    // Create animated particles
    const particleGeometry = new THREE.BufferGeometry();
    const particleCount = 1000;
    const positions = new Float32Array(particleCount * 3);
    const colors = new Float32Array(particleCount * 3);

    for (let i = 0; i < particleCount * 3; i += 3) {
        positions[i] = (Math.random() - 0.5) * 20;
        positions[i + 1] = (Math.random() - 0.5) * 20;
        positions[i + 2] = (Math.random() - 0.5) * 20;

        const brandColor = new THREE.Color(0xa855f7);
        colors[i] = brandColor.r;
        colors[i + 1] = brandColor.g;
        colors[i + 2] = brandColor.b;
    }

    particleGeometry.setAttribute('position', new THREE.BufferAttribute(positions, 3));
    particleGeometry.setAttribute('color', new THREE.BufferAttribute(colors, 3));

    const particleMaterial = new THREE.PointsMaterial({
        size: 0.05,
        vertexColors: true,
        transparent: true,
        opacity: 0.6
    });

    particles = new THREE.Points(particleGeometry, particleMaterial);
    scene.add(particles);

    // Animate
    function animate() {
        animationId = requestAnimationFrame(animate);

        particles.rotation.x += 0.001;
        particles.rotation.y += 0.001;

        camera.position.x += Math.sin(Date.now() * 0.0005) * 0.01;
        camera.position.y += Math.cos(Date.now() * 0.0005) * 0.01;

        renderer.render(scene, camera);
    }
    animate();

    // Handle resize
    window.addEventListener('resize', () => {
        const width = canvas.clientWidth;
        const height = canvas.clientHeight;

        camera.aspect = width / height;
        camera.updateProjectionMatrix();
        renderer.setSize(width, height);
    });
}

function cleanup() {
    if (animationId) {
        cancelAnimationFrame(animationId);
    }
    if (renderer) {
        renderer.dispose();
    }
}

// Initialize on load
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initThreeScene);
} else {
    initThreeScene();
}

// Cleanup on page unload
window.addEventListener('beforeunload', cleanup);

export { initThreeScene, cleanup };
