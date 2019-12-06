import matplotlib.pyplot as plt
import librosa.display
import librosa
import time
import os


import wave
# import pyaudio
# import pylab as pl
import numpy as np
# import pylab

# import numpy
# import pandas
from scipy import signal
from scipy.signal import butter, lfilter

from scipy.signal import freqz


EXPORT_PNG = False

OUTPUT_DIR = 'output'


def normalize(x, axis=0):
    import sklearn
    return sklearn.preprocessing.minmax_scale(x, axis=axis)


def ZeroCrossings(x, sr):
    zero_crossings = librosa.zero_crossings(x, pad=False)
    print("zero crossings:", sum(zero_crossings))

    if EXPORT_PNG:
        librosa.display.waveplot(x, sr=sr)
        plt.figure(figsize=(14, 5))
        plt.plot(x)
        plt.savefig("zero_crossings.png")
    return sum(zero_crossings)


def Spectral(x, sr):
    spectral_centroids = librosa.feature.spectral_centroid(x, sr=sr)[0]
    frames = range(len(spectral_centroids))
    print("spectral_centroids:", spectral_centroids.shape)

    t = librosa.frames_to_time(frames)
    plt.figure(figsize=(14, 5))
    librosa.display.waveplot(x, sr=sr, alpha=0.4)
    plt.plot(t, normalize(spectral_centroids), color='r')
    if EXPORT_PNG:
        plt.savefig("spectral_centroids.png")

    spectral_rolloff = librosa.feature.spectral_rolloff(x+0.01, sr=sr)[0]
    print("spectral_rolloff:", spectral_rolloff.shape)

    plt.figure(figsize=(14, 5))
    librosa.display.waveplot(x, sr=sr, alpha=0.4)
    plt.plot(t, normalize(spectral_rolloff), color='r')
    if EXPORT_PNG:
        plt.savefig("spectral_rolloff.png")
    return spectral_centroids.shape, spectral_rolloff.shape


def Mfccs(x, sr):
    mfccs = librosa.feature.mfcc(x, sr=sr, S=None, n_mfcc=13)
    result = []
    for i in range(13):
        result.append(np.mean(mfccs[i]))
    # print("mfccs:", mfccs.shape)

    if EXPORT_PNG:
        plt.figure(figsize=(14, 5))
        librosa.display.specshow(mfccs, sr=sr, x_axis='time')
        plt.savefig("mfccs.png")
    return result


def Chromagram(x, sr):
    chromagram = librosa.feature.chroma_stft(x, sr=sr, hop_length=512)
    print("chromagram:", chromagram.shape)

    plt.figure(figsize=(15, 5))
    librosa.display.specshow(chromagram, x_axis='time',
                             y_axis='chroma', hop_length=512, cmap='coolwarm')
    if EXPORT_PNG:
        plt.savefig("chromagram.png")

    # librosa.display.specshow(
    #     S_dB, x_axis='time', y_axis='mel', sr=sr, fmax=8000)
    return chromagram.shape


def analyseWave(path, filename, filewriter):
    # wave_result = wave.open(filename)
    # print(wave_result)
    print(path+'/'+filename)
    x, sr = librosa.load(path+'/'+filename)

    zc = ZeroCrossings(x, sr)
    # Spectral(x, sr)
    mfcc = Mfccs(x, sr)
    # Chromagram(x, sr)
    output_str = "{0};{1};{2}".format(filename, path, zc)
    for m in mfcc:
        output_str = "{0};{1}".format(output_str, m)
    # print(output_str)
    filewriter.write(output_str + "\n")


if __name__ == "__main__":
    # numpy.mean()
    # analyseWave('', "bird/Flame-robin/5ad86f43a13efe0457c37896.wav")

    tb = time.time()

    if not os.path.exists(OUTPUT_DIR):
        print('cant fount output directory!!!')
    else:
        csv = open('output.csv', 'w')
        csv.write(
            'filenname;path;zero_crossing;mfcc1;mfcc2;mfcc3;mfcc4;mfcc5;mfcc6;mfcc7;mfcc8;mfcc9;mfcc10;mfcc11;mfcc12;mfcc13\n')
        for subdir in os.listdir(OUTPUT_DIR):
            p = OUTPUT_DIR+'/'+subdir
            if os.path.isdir(p):
                for file in os.listdir(p):
                    if file.endswith('.wav'):
                        analyseWave(p, file, csv)
                        # break

    te = time.time()
    print('time pass:', te-tb)
