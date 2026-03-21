import sharp from 'sharp';
import fs from 'fs';

async function compress() {
  const files = ['img/hero_kids.webp', 'img/Logo_CLIL BRITISH_METHOD.webp'];
  
  for (const file of files) {
    if (fs.existsSync(file)) {
        const size = fs.statSync(file).size;
        const optFile = file.replace('.webp', '_opt.webp');
        
        await sharp(file).webp({ quality: 60, effort: 6 }).toFile(optFile);
        
        const newSize = fs.statSync(optFile).size;
        console.log(`${file}: ${Math.round(size/1024)}KB -> ${Math.round(newSize/1024)}KB`);
    }
  }
}

compress();
