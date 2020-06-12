import matplotlib.pyplot as plt
import librosa.display
import librosa
import sys
import os


import wave
# import pyaudio
# import pylab as pl
import numpy as np
# import pylab

import numpy
# import pandas
from scipy import signal
from scipy.signal import butter, lfilter

from scipy.signal import freqz


EXPORT_PNG = True


def normalize(x, axis=0):
    import sklearn
    return sklearn.preprocessing.minmax_scale(x, axis=axis)


def ZeroCrossings(x, sr):
    zero_crossings = librosa.zero_crossings(x, pad=False)
    print("zero crossings:", sum(zero_crossings))

    librosa.display.waveplot(x, sr=sr)
    plt.figure(figsize=(14, 5))
    plt.plot(x)
    if EXPORT_PNG:
        plt.savefig("zero_crossings.png")
    return zero_crossings


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
    mfccs = librosa.feature.mfcc(x, sr=sr)
    print("mfccs:", mfccs)
    print("mfccs:", len(mfccs[0]))
    print("mfccs:", mfccs.shape)

    plt.figure(figsize=(14, 5))
    librosa.display.specshow(mfccs, sr=sr, x_axis='time')
    if EXPORT_PNG:
        plt.savefig("mfccs.png")
    return mfccs.shape


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


def analyseWave(path, filename):
    # wave_result = wave.open(filename)
    # print(wave_result)
    x, sr = librosa.load('{0}/{1}'.format(path, filename))
    # print(x)
    # print(len(x))
    # print(sr)
    # print("====")
    # plt.subplot(211)
    # plt.plot(x)
    # plt.title("original wave")
    # plt.subplot(212)
    # filtered_sine = butter_highpass_filter(x, 10, 44000)
    # plt.plot(filtered_sine)
    # plt.title("low high pass filter wave")
    # plt.show()
    # return
    # print(x)
    # print(filtered_sine)
    # x = filtered_sine

    # librosa.feature.melspectrogram(y=x, sr=sr, n_mels=128, fmax=44100)
    # plt.show()
    # y, sr = librosa.load(librosa.util.example_audio_file())
    # import numpy as np
    # import matplotlib.pyplot as plt
    from scipy.signal import freqz

    # Sample rate and desired cutoff frequencies (in Hz).
    fs = 5000.0
    lowcut = 400.0
    highcut = 1250.0

    # Plot the frequency response for a few different orders.
    # plt.figure(1)
    # plt.clf()
    # for order in [3, 6, 9]:
    #     b, a = butter_bandpass(lowcut, highcut, fs, order=order)
    #     w, h = freqz(b, a, worN=2000)
    #     plt.plot((fs * 0.5 / np.pi) * w, abs(h), label="order = %d" % order)

    # plt.plot([0, 0.5 * fs], [np.sqrt(0.5), np.sqrt(0.5)],
    #          '--', label='sqrt(0.5)')
    # plt.xlabel('Frequency (Hz)')
    # plt.ylabel('Gain')
    # plt.grid(True)
    # plt.legend(loc='best')

    # Filter a noisy signal.
    # T = 0.05
    # nsamples = T * fs
    # t = np.linspace(0, T, nsamples, endpoint=False)
    # a = 0.02
    # f0 = 600.0
    # x = 0.1 * np.sin(2 * np.pi * 1.2 * np.sqrt(t))
    # x += 0.01 * np.cos(2 * np.pi * 312 * t + 0.1)
    # x += a * np.cos(2 * np.pi * f0 * t + .11)
    # x += 0.03 * np.cos(2 * np.pi * 2000 * t)
    # plt.figure(2)
    # plt.clf()
    # plt.plot(x, label='Noisy signal')

    y = butter_bandpass_filter(x, lowcut, highcut, fs, order=6)
    # plt.plot(y, label='Filtered signal (%g Hz)' % f0)
    # plt.xlabel('time (seconds)')
    # plt.hlines([-a, a], 0, T, linestyles='--')
    # plt.grid(True)
    # plt.axis('tight')
    # plt.legend(loc='upper left')

    # plt.show()
    # return

    librosa.display.waveplot(x, sr=sr)
    librosa.display.waveplot(y, sr=sr)
    plt.title('difference')
    plt.savefig('pic/{0}.dn.png'.format(filename))

    y = x
    librosa.feature.melspectrogram(y=y, sr=sr)
    D = numpy.abs(librosa.stft(y))**2
    S = librosa.feature.melspectrogram(S=D, sr=sr)

    S = librosa.feature.melspectrogram(y=y, sr=sr, n_mels=128, fmax=44100)

    plt.figure(figsize=(10, 4))
    S_dB = librosa.power_to_db(S, ref=numpy.max)
    librosa.display.specshow(
        S_dB, x_axis='time', y_axis='mel', sr=sr, fmax=44100)
    plt.colorbar(format='%+2.0f dB')
    plt.title('Mel-frequency spectrogram')
    plt.tight_layout()
    plt.savefig('pic/{0}.mel1.png'.format(filename))
    # plt.show()
    plt.close('all')

    # Display click waveform next to the spectrogram
    # tempo, beats = librosa.beat.beat_track(x, sr)
    # times = librosa.frames_to_time(beats, sr=sr)
    # y_beat_times = librosa.clicks(times=times, sr=sr)

    # plt.figure()
    # S = librosa.feature.melspectrogram(y=y, sr=sr)
    # ax = plt.subplot(2, 1, 2)
    # librosa.display.specshow(librosa.power_to_db(S, ref=np.max),
    #                          x_axis='time', y_axis='mel')
    # plt.subplot(2, 1, 1, sharex=ax)
    # librosa.display.waveplot(y_beat_times, sr=sr, label='Beat clicks')
    # plt.legend()
    # plt.xlim(15, 30)
    # plt.tight_layout()
    # plt.show()
    return
    # ZeroCrossings(x, sr)
    # Spectral(x, sr)
    # Mfccs(x, sr)
    # Chromagram(x, sr)


def checkFolder(path):
    print("path: " + path)
    for file in os.listdir(path):
        if os.path.isdir(path + "/" + file):
            checkFolder(path+"/"+file)
            print("dir:" + file)
        else:
            print("file:" + file)


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
    b, a = butter(order, [low, high], btype='band')
    return b, a


def butter_bandpass_filter(data, lowcut, highcut, fs, order=5):
    b, a = butter_bandpass(lowcut, highcut, fs, order=order)
    y = lfilter(b, a, data)
    return y


if __name__ == "__main__":
    # numpy.mean()
    # analyseWave("bird/Flame-robin/5ad86f43a13efe0457c37896.wav")

    newFolder = 'pic/'

    if len(sys.argv) == 2:
        path = sys.argv[1]
        for file in os.listdir(path):
            if file.endswith('wav'):
                analyseWave(path, file)
    else:
        path = '.'

        # checkFolder(".")
