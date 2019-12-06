from scipy.signal import butter, lfilter
from scipy import signal
import numpy as np
import librosa
import time
import sys
import os

# from scipy.signal import freqz


def butter_highpass(cutoff, fs, order=5):
    nyq = 0.5 * fs
    normal_cutoff = cutoff / nyq
    b, a = signal.butter(order, normal_cutoff, btype='high', analog=False)
    return b, a


def butter_highpass_filter(data, cutoff, fs, order=5):
    b, a = butter_highpass(cutoff, fs, order=order)
    y = signal.filtfilt(b, a, data)
    return y


def butter_bandpass(lowcut, highcut, fs, order=5):
    nyq = 0.5 * fs
    low = lowcut / nyq
    high = highcut / nyq
    print(low, high, order)
    b, a = butter(order, [low, high], btype='band')
    return b, a


def butter_bandpass_filter(data, lowcut, highcut, fs, order=5):
    b, a = butter_bandpass(lowcut, highcut, fs, order=order)
    y = lfilter(b, a, data)
    return y


def bandpassFilter(path, file):
    print(file)
    x, sr = librosa.load(path+'/'+file, sr=None)

    fs = 1000.0
    lowcut = 1000.0
    highcut = 12500.0
    y = butter_bandpass_filter(x, lowcut, sr*2/5, sr, order=6)
    return x, y, sr


def cutWave(newFolder, waveID, x, sr):
    num = int(len(x)/sr)+1
    for i in range(num):
        begin = i*sr
        end = min((i+1)*sr, len(x))
        if end - begin > sr/2:
            print('begin:', begin, 'end:', end)
            newWave = x[begin:end]
            newWaveFile = "{0}/{1}_{2}.wav".format(newFolder, waveID, i)
            print('new cut wave file:'+newWaveFile)
            librosa.output.write_wav(newWaveFile, newWave, sr)


def process(newFolder, path, file):
    # print('wave input:', file, newFolder, path)
    result = file.split('.')
    waveID = result[0]
    x, y, sr = bandpassFilter(path, file)
    # print(newFolder)
    # print(waveID)

    newfile = "{0}{1}_bpf.wav".format(newFolder, waveID)
    print('output:' + path + newfile)
    librosa.output.write_wav(newfile, y, sr)
    cutWave(newFolder, waveID, y, sr)


def processDir(Folder, path):
    print(Folder, path)
    for file in os.listdir(path):
        if file == 'output':
            continue
        if os.path.isdir(file):
            newFolder = Folder+file+'/'
            newPath = path+'/'+file
            # print(newFolder, newPath, '===', os.path.exists(newFolder))
            if not os.path.exists(newFolder):
                print('create new folder:', newFolder)
                os.mkdir(newFolder)
            processDir(newFolder, newPath)
        elif file.endswith('.wav'):
            process(Folder, path, file)


if __name__ == "__main__":
    # numpy.mean()
    # cutWave("bird/Flame-robin/5ad86f43a13efe0457c37896.wav")
    tb = time.time()

    if len(sys.argv) == 2:
        path = sys.argv[1]
        newFolder = 'output/{0}'.format(path)
    else:
        path = '.'
        newFolder = 'output/'

    if not os.path.exists('output'):
        os.mkdir('output')

    outputPaht = path.replace('/', '_')
    print(newFolder)
    if not os.path.exists(newFolder):
        os.mkdir(newFolder)

    processDir(newFolder, path)

    te = time.time()
    print("pass time:", te-tb)
